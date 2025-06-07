                <div class="lg:ml-3 mt-6 flex flex-col self-start rounded-lg bg-white text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white sm:shrink-0 sm:grow sm:basis-0">
                    <a class="ml-4" type="button">
                        <div class="flex items-start justify-start">
                            <button id="googlePayButton" class="flex flex-col items-start justify-start mt-12 border-2 border-green-300 rounded-lg cursor-pointer bg-green-50 hover:bg-green-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center p-5">
                                    <span class="text-lg font-bold">Pay with Google Pay</span>
                                </div>
                            </button>
                        </div>
                    </a>
                </div>
                <script src="https://pay.google.com/gp/p/js/pay.js"></script>
                <script>
                    const paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});

                    const request = {
                        apiVersion: 2,
                        apiVersionMinor: 0,
                        allowedPaymentMethods: [{
                            type: 'CARD',
                            parameters: {
                                allowedAuthMethods: ['PAN_ONLY', 'CRYPTOGRAM_3DS'],
                                allowedCardNetworks: ['MASTERCARD', 'VISA'],
                            },
                            tokenizationSpecification: {
                                type: 'PAYMENT_GATEWAY',
                                parameters: {
                                    gateway: 'example',
                                    merchantId: 'exampleMerchantId'
                                }
                            }
                        }],
                        merchantInfo: {
                            merchantId: '12345678901234567890',
                            merchantName: 'Example Merchant'
                        },
                        transactionInfo: {
                            totalPriceStatus: 'FINAL',
                            totalPrice: '10.00',
                            currencyCode: 'USD',
                            countryCode: 'US'
                        }
                    };

                    document.getElementById('googlePayButton').addEventListener('click', function() {
                        paymentsClient.loadPaymentData(request).then(function(paymentData) {
                            // Handle the response
                            console.log(paymentData);
                        }).catch(function(err) {
                            console.error(err);
                        });
                    });
                </script> 