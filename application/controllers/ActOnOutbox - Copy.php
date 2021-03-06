<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ActOnOutbox extends CI_Controller{

    function __construct() {
        parent::__construct();
		$this->load->model('user_model');
		$this->load->model('actOnOutbox_model');

    }

    
	function dummy()
	{
		
		
		
		//Generating Response -----------------------------------------------------------------
		$responseArray[]['fetchedDataCount'] 				= 0;
		$responseArray[]['totalSMSCount'] 					= 0;
		$responseArray[]['routeDetectionFailedDataCount'] 	= 0;
		$responseArray[]['insufficientBalance'] 			= 0;
		$responseArray[]['balanceDeductonFailedDataCount'] 	= 0;
		$responseArray[]['processedDataCount'] 				= 0;
		$responseArray[]['totalCalculatedUserCost'] 		= 0;
		$responseArray[]['totalSuccessful'] 				= 0;


		$jsonResponseArray = json_encode($responseArray);
		
		echo $jsonResponseArray;
		return;
		
	}
	
	
    function index()
	{
		
		$fetchedDataCount = 0 ;
		$routeDetectionFailedDataCount = 0 ;
		$totalSMSCount = 0 ;
		$insufficientBalance = 0 ;
		$balanceDeductonFailedDataCount = 0 ;
		$processedDataCount = 0 ;
		$routeId = 0;
		$totalCalculatedUserCost = 0;
		$totalSuccessful = 0;
		
		//Request parameter for fetch data from Outbox table
		// $status = $_REQUEST['status'];
		// $limit 	= $_REQUEST['limit'];
		
		// $requestJsonData = file_get_contents("php://input");
		// $requestJsonData = json_decode(file_get_contents("php://input"));
		
		// $requestDataArray = json_decode($requestJsonData);
		
		// echo'<pre />';
		// print_r($requestJsonData);
		// die('test from live actOnOutbox checking');
		
		// $limit 	= $requestDataArray->pullcount;
		// $status = $requestDataArray->routeid;
		
		$limit 	= '500';
		$status = '-7';
		
		
		
		//Fetching Data from outbox
		$unprocessedDataArray = $this->actOnOutbox_model->fetchOutboxData($status, $limit);

		// die("LOL");
		
		if(!empty($unprocessedDataArray))
		{
			//Updating initial status to processed status--------Start
			foreach($unprocessedDataArray as $unprocessedDatam)
			{
				$processedDataArray[$fetchedDataCount] = $unprocessedDatam;
				$processedDataArray[$fetchedDataCount]['msg_status'] = '-6';//Processed Status
				
				$fetchedDataCount++;
			}
			
			//Batch updating------------------------------------------------------
			$isUpdated = $this->actOnOutbox_model->batchUpdate($processedDataArray);
			
			//Updating initial status to processed status--------End
			
			
			foreach($processedDataArray as $processedDatam)
			{
				//Assaigning into veriable
				$outbox_id 		= $processedDatam['id'];			
				$msisdn 		= $processedDatam['contact_text'];
				$cd_user_id 	= $processedDatam['cd_user_id'];
				$message 		= $processedDatam['message'];
				
				
				//Getting oprerator prefix from msisdn of outbox datam
				$MobileOperatorCode = substr($msisdn, 0, 5);
				
				if($processedDatam['contact_text'] == NULL)
				{
					$processedDataArray[$processedDataCount]['msg_status'] = '-13';//Route Detection Failed Status
					$routeDetectionFailedDataCount++;
				}
				else
				{
					//Counting per SMS length---------------------------------
					$countedSMS 	= $this->actOnOutbox_model->smsCount($message);
					$totalSMSCount 	= $totalSMSCount + $countedSMS;
					
					
					//Detecting Route Information by User Id and Operator---------------------------------------------
					$operatorRouteInfo = $this->actOnOutbox_model->getPriceByOperator($MobileOperatorCode, $cd_user_id);

					//If Route Information Not Available
					if($operatorRouteInfo == false)
					{
						$processedDataArray[$processedDataCount]['msg_status'] = '-4';//Route Detection Failed Status
						$routeDetectionFailedDataCount++;
					}
					//If Route Information Available
					else
					{
						
						$trx_id 		= $processedDatam['trx_id'];
						$smsMask 		= $processedDatam['smsMask'];
						$schedule_time 	= $processedDatam['schedule_time'];
						$schedule_time 	= $processedDatam['schedule_time'];
						
						
						//Getting Route ID acccording with Operator--------
						$routeId 			= $operatorRouteInfo->route_id;
						$processedDataArray[$processedDataCount]['route_id'] 	= $routeId;//Updating Route ID
						
						
						//Multipling SMS count with user's terrif--------		
						$userRate 			= $operatorRouteInfo->terrif;				
						$calculatedUserCost = $countedSMS * $userRate;
						$totalCalculatedUserCost = $totalCalculatedUserCost + $calculatedUserCost;
						
						
						//Checking is there avialable balance in user's account -----------------------------
						$creditInfo = $this->actOnOutbox_model->checkCredit( $cd_user_id, $calculatedUserCost);
						
						// echo '<pre/>';
						// print_r($creditInfo);
						
						
						if($creditInfo == false)
						{
							$processedDataArray[$processedDataCount]['msg_status'] = '-3';//Credit Retrieve Failed Status
						}
						else
						{
							
							$activeCreditId 	= $creditInfo->id;
							$remainingCredit 	= $creditInfo->remaining_credit;
							$usageCredit 		= $creditInfo->sms_usage;
							
							
							
						// echo '<pre/>';
						// print_r($remainingCredit);
						// echo '<br/>';
						// print_r($calculatedUserCost);
						// if($remainingCredit <= $calculatedUserCost)
							// {
								// die("LOL");
								// $processedDataArray[$processedDataCount]['msg_status'] = '-98';//Insufficient Balance Status
								// $insufficientBalance++;//Insufficient Balance Status
							// }
							
						// die('ActCI@49');
						
						
							//If there is not avialable credit 
							if($remainingCredit <= $calculatedUserCost)
							{
								$processedDataArray[$processedDataCount]['msg_status'] = '-9';//Insufficient Balance Status
								$insufficientBalance++;//Insufficient Balance Status
							}
							//If availabe credit
							else
							{
								$newUsageCredit		= $usageCredit + $calculatedUserCost;
								$newRemainingCredit = $remainingCredit - $calculatedUserCost;
								
								$updateCredit['sms_usage'] 			= $newUsageCredit;
								$updateCredit['remaining_credit'] 	= $newRemainingCredit;
								
								// print_r($updateCredit);
								
								// echo '<pre/>';
								// print_r($newRemainingCredit);
								// print_r($calculatedUserCost);
								
								$isDeducted = $this->actOnOutbox_model->deductCredit( $activeCreditId, $updateCredit);
								
								if($isDeducted == false)
								{
									$processedDataArray[$processedDataCount]['msg_status'] = '-2';//Balance Deducton Failed Status
									$balanceDeductonFailedDataCount++;
								}
								else
								{
									$processedDataArray[$processedDataCount]['assigned_cost'] = $userRate;//Balance Deducton Failed Status
									$processedDataArray[$processedDataCount]['deducted_cost'] = $calculatedUserCost;//Balance Deducton Failed Status					
									$processedDataArray[$processedDataCount]['msg_status'] 	= '0';//Balance Deducton Successful Status
									$totalSuccessful++;
								}
							}
							
						}
						
						// echo '<pre/>';
						// print_r($creditInfo);
						// print_r($calculatedUserCost);
						
						// die('ActCI@49');
						
						
						//Updating initial status to processed status
						// $this->actOnOutbox_model->UpdateStatus($outbox_id);
						// $this->actOnOutbox_model->UpdateStatus($outbox_id);
							
						
						//Check mobile operator
						// $isValidOperator = $this->actOnOutbox_model->CheckOperator($outbox_id);
						
						
					
					}

				}
				
				$processedDataCount++;
			
			
			}
			
			// echo '<pre/>';
			// print_r($creditInfo);
			// print_r($calculatedUserCost);
			
			// die('ActCI@49');
			
			//Uncomment***************************************************************************
			$isValidOperator = $this->actOnOutbox_model->batchUpdate($processedDataArray);
		}
		
		
		//Generating Response -----------------------------------------------------------------
		$responseArray[]['fetchedDataCount'] 				= $fetchedDataCount;
		$responseArray[]['totalSMSCount'] 					= $totalSMSCount;
		$responseArray[]['routeDetectionFailedDataCount'] 	= $routeDetectionFailedDataCount;
		$responseArray[]['insufficientBalance'] 			= $insufficientBalance;
		$responseArray[]['balanceDeductonFailedDataCount'] 	= $balanceDeductonFailedDataCount;
		$responseArray[]['processedDataCount'] 				= $processedDataCount;
		$responseArray[]['totalCalculatedUserCost'] 		= $totalCalculatedUserCost;
		$responseArray[]['totalSuccessful'] 				= $totalSuccessful;


		$jsonResponseArray = json_encode($responseArray);
		
		echo $jsonResponseArray;
		return;
		
	}
	
	

}

