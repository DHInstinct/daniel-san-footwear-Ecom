<?

    require_once("../../config.php");

    require_once("../../classes/vendor/autoload.php");

    $weight = $_POST['weight'];
    $zip  = $_POST['zip'];
    $serviceType  = '03';

    $rate = new Ups\Rate(
        $access = "DD991D6C54725DD2",
        $userid = "DHInstict",
        $passwd = "Chickenfart69!"
    );

    try {
        $shipment = new \Ups\Entity\Shipment();

        $shipperAddress = $shipment->getShipper()->getAddress();
        $shipperAddress->setPostalCode('45619');//Hard coded for project reqs

        $address = new \Ups\Entity\Address();
        $address->setPostalCode('45619');//Hard coded for project reqs
        $shipFrom = new \Ups\Entity\ShipFrom();
        $shipFrom->setAddress($address);


        //Set service type (3 Day Select vs Ground, etc.)
        $service = new \Ups\Entity\Service();
        $service->setCode($serviceType);

        $shipment->setService($service);
 

        $shipment->setShipFrom($shipFrom);


        $shipTo = $shipment->getShipTo();
        $shipTo->setCompanyName('Test Ship To');
        $shipToAddress = $shipTo->getAddress();
        $shipToAddress->setPostalCode($zip);

        $package = new \Ups\Entity\Package();
        $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_UNKNOWN);
        $package->getPackageWeight()->setWeight($weight);
        
        /*$weightUnit = new \Ups\Entity\UnitOfMeasurement;
        $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
        $package->getPackageWeight()->setUnitOfMeasurement($weightUnit);*/

        $dimensions = new \Ups\Entity\Dimensions();
        $dimensions->setHeight(10);
        $dimensions->setWidth(10);
        $dimensions->setLength(10);

        $unit = new \Ups\Entity\UnitOfMeasurement;
        $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);

        $dimensions->setUnitOfMeasurement($unit);
        $package->setDimensions($dimensions);

        $shipment->addPackage($package);

        
        $calcRate = $rate->getRate($shipment);

        //Pull the shipping rate from UPS returned SOAP
        $shippingRate = $calcRate->RatedShipment[0]->TotalCharges->MonetaryValue;
        


        //var_dump($rate->getRate($shipment));
        } catch (Exception $e) {
            var_dump($e);
        }

        echo json_encode($shippingRate);


?>