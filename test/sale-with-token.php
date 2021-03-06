<?php
require_once "../lib/maxipago/Autoload.php"; // Remove if using a globa autoloader
require_once "../lib/maxiPago.php";

try {

    $maxiPago = new maxiPago;

    // Before calling any other methods you must first set your credentials
    // Define Logger parameters if preferred
    // Do *NOT* use 'DEBUG' for Production environment as Credit Card details WILL BE LOGGED
    // Severities INFO and up are safe to use in Production as Credi Card info are NOT logged
    $maxiPago->setLogger(dirname(__FILE__).'/logs','INFO');
    
    // Set your credentials before any other transaction methods
    $maxiPago->setCredentials("12345", "123456789");

    $maxiPago->setDebug(true);
    $maxiPago->setEnvironment("TEST");
    $data = array(
    		"processorID" => "1", // REQUIRED - Use '1' for testing. Contact our team for production values //
    		"referenceNum" => "TestTransaction123", // REQUIRED - Merchant internal order number //
    		"fraudCheck" => "N",
    		"chargeTotal" => "0.01", // REQUIRED - Transaction amount in US format //
    		"numberOfInstallments" => "", // Optional - Number of installments ("parcelas") for the credit card transaction //
    		"chargeInterest" => "", // Optional - Charge interest flag (Y/N), used with installments. ("com" e "sem" juros) //
    		"currencyCode" => "", // Optional - Valid only for ChasePaymentech multi-currecy setup. Please see full documentation for more info//
    		"token" => "pUoxkdDfgAVgJR4AQc9sZQ==", // REQUIRED for this command - Credit card token created by maxiPago! //
    		"customerId" => "44695510",
    		"billingId" => "2546582",
    		"billingName" => "Fulano de Tal", // RECOMMENDED - Customer name //
    		"billingAddress" => "Av. Republica Livre, 230", // Optional - Customer address //
    		"billingAddress2" => "16 Andar", // Optional - Customer address //
    		"billingDistrict" => "Centro",
    		"billingCity" => "Sao Paulo", // Optional - Customer city //
    		"billingState" => "SP", // Optional - Customer state with 2 characters //
    		"billingPostalCode" => "08021310", // Optional - Customer zip code //
    		"billingCountry" => "BR", // Optional - Customer country code per ISO 3166-2 //
    		"billingPhone" => "1132890900", // Optional - Customer phone number //
    		"billinEmail" => "billing@maxipago.com", // Optional - Customer email address //
    		"billingCompanyName" => "BillingCompany",
    		"billingType" => "Individual",
    		"billingGender" => "M",
    		"billingBirthDate" => "1982-03-08",
    		"billingPhoneType" => "Commercial",
    		"billingPhoneCountryCode" => "55",
    		"billingPhoneAreaCode" => "11",
    		"billingPhoneNumber" => "32890900",
    		"billingPhoneExtension" => "123",
    		"billingDocumentType" => "CPF",
    		"billingDocumentValue" => "25922837060",
    		"shippingId" => "2546582",
    		"shippingName" => "Fulano de Tal", // RECOMMENDED - Customer name //
    		"shippingAddress" => "Av. Republica Livre, 230", // Optional - Customer address //
    		"shippingAddress2" => "16 Andar", // Optional - Customer address //
    		"shippingDistrict" => "Centro",
    		"shippingCity" => "Sao Paulo", // Optional - Customer city //
    		"shippingState" => "SP", // Optional - Customer state with 2 characters //
    		"shippingPostalCode" => "08021310", // Optional - Customer zip code //
    		"shippingCountry" => "BR", // Optional - Customer country code per ISO 3166-2 //
    		"shippingPhone" => "1132890900", // Optional - Customer phone number //
    		"shippingEmail" => "billing@maxipago.com", // Optional - Customer email address //
    		"shippingType" => "Individual",
    		"shippingGender" => "M",
    		"shippingBirthDate" => "1982-03-08",
    		"shippingPhoneType" => "Commercial",
    		"shippingPhoneCountryCode" => "55",
    		"shippingPhoneAreaCode" => "11",
    		"shippingPhoneNumber" => "32890900",
    		"shippingPhoneExtension" => "123",
    		"shippingDocumentType" => "CPF",
    		"shippingDocumentValue" => "25922837060",
    		"cvvNumber" => "721", // RECOMMENDED - Credit card verification code //
    		"chargeTotal" => "10.00", // REQUIRED - Transaction amount in US format //
    		"shippingTotal" => "10.00",
    		"softDescriptor" => "ORDER12313", // Optional - Text printed in customer's credit card statement (Cielo only) //,
    		"currencyCode" => "BRL", // Optional - Valid only for ChasePaymentech multi-currecy setup. Please see full documentation for more info//
    		"iataFee" => "1.00",
    		"numberOfInstallments" => "2", // Optional - Number of installments ("parcelas") //
    		"chargeInterest" => "N", // Optional - Charge interest flag (Y/N), used with installments ("com" ou "sem" juros) //
    		"comments" => "Pedido de teste.", // Optional - Additional comments //
    		"fraudProcessorID" => "99",
    		"captureOnLowRisk" => "N",
    		"voidOnHighRisk" => "N",
    		"websiteId" => "DEFAULT",
    		"fraudToken" => "q1234564987981alksf43549138",
    		"itemIndex" => "1",
    		"itemProductCode" => "a123456",
    		"itemDescription" => "Produto de teste",
    		"itemQuantity" => "1",
    		"itemTotalAmount" => "10",
    		"itemUnitCost" => "10.00",
    );
    $maxiPago->creditCardSale($data);

    if ($maxiPago->isErrorResponse()) {
        echo "Transaction has failed<br>Error message: ".$maxiPago->getMessage();
    }

    elseif ($maxiPago->isTransactionResponse()) {
        if ($maxiPago->getResponseCode() == "0") { echo "Transaction Approved<br>Authorization code: ".$maxiPago->getAuthCode(); }
        else { echo "Transaction Declined<br>Decline message: ".$maxiPago->getMessage(); }    
    }

}

catch (Exception $e) { echo $e->getMessage()." in ".$e->getFile()." on line ".$e->getLine(); }
?>
