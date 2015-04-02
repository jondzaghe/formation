<?php
namespace App\Frontend\Modules\Device;

use \OCFram\BackController;
use \OCFram\HTTPRequest;



class DeviceController extends BackController{



	 public function executeIsDevice(HTTPRequest $request){
	 	$detect = new \Mobile_Detect;

	 	$device = $this->getDevice($detect);

	 	$this->page->addVar('device', $device);
	 }


	 public function getDevice($detect){

	 	$device = "";

	 	//THE DEVICE IS A MOBILE DEVICE
	 	if ( $detect->isMobile() ) {

	 		$device .= "Mobile";

	 		if( $detect->isiOS() ){
 
 				$device .= " Apple version(" . $detect->version('Apple') . ")";
			}
			else{
				$detect->isAndroidOS();

				$device .= " Android version (" . $detect->version('Android') . ")";
			}


			return $device;
	 
		}

		//THE DEVICE IS A TABLET DEVICE
		if( $detect->isTablet() ){

 			$device .= "Tablette";

 			if( $detect->isiOS() ){
 
 				$device .= " Apple version(" . $detect->version('Apple') . ")";
			}
			else{
				if($detect->isAndroidOS()){
					$device .= " Android version(" . $detect->version('Android') . ")";
				}
			}

			return $device;
		}

		$device .= "PC";

		return $device;

	 }

}