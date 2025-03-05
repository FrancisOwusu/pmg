/**
 * Created by Francis on 12/10/2023.
 */

var IPay = function () {
    var paymentForm = $(".payment-form");
    var paymentModal = $("#payment-modal");
    var btnPay = $(".btn-pay-b");
    var $table = $("#invoice-table");


    return {

        init: function () {
            paymentForm.on("submit",function (e){
                e.preventDefault();
                e.stopImmediatePropagation();
                var ajaxOptions = {
                    type: 'POST',
                    url: paymentForm.attr('action'),
                    data: paymentForm.serialize(),
                    dataType: "json",
                    beforeSend: function (xhr) {
                        if (paymentForm.valid()) {
                            Common.showSpinner(paymentForm, "Processing...");
                            return true;
                        } else {
                            return false;
                        }
                    }
                };
                $.ajax(ajaxOptions).done(function (response) {
                    Common.hideSpinner(paymentForm);
                    if (response.status === 200) {
                        IPay.resetPayForm();
                        window.open(response.data.authorization_url,"_blank");
                        // Common.showMessage(response.msg);
                    } else {

                        Common.onError("Something Went Wrong,try again");
                    }
                }).always(function (xhr) {
                    Common.hideSpinner(paymentForm);
                }).fail(function (xhr, textStatus, error) {
                    Common.hideSpinner(paymentForm);
                    if (textStatus !== "canceled") {
                        Common.onError("Sorry An Error Occured Whiles Processing The Request. Kindly Try Again Later.");
                    }
                });
            });
            // $(document).on("click", ".btn-pay-b", function (e) {
            //     // btnPay = $(this).attr("id");
            //     e.preventDefault();
            //     e.stopImmediatePropagation();
            //     IPay.validateForm()
            //     IPay.pay();
            // });
            btnPay.on('submit',function (e) {
                // var buttonId = $(this).attr("id");
                // alert("Clicked on " + buttonId);
                e.preventDefault();
                e.stopImmediatePropagation();
                IPay.validateForm()
                IPay.pay();
            });
            // $("#dynamic-elements-container").on("click", "button[id^='dynamic-button-']", function () {
            //     // This function will handle the click event for all buttons with IDs that start with "dynamic-button-"
            //
            // });
            // $("#payment-form").on('click',function (e) {
            //     // var buttonId = $(this).attr("id");
            //     // alert("Clicked on " + buttonId);
            //     e.preventDefault();
            //     e.stopImmediatePropagation();
            //     IPay.validateForm()
            //     IPay.pay();
            // });




        },
        refreshDT: function () {
            try {
                $table.DataTable().ajax.reload();
            } catch (e) {
            }
        },
        pay: function () {
            var ajaxOptions = {
                type: 'POST',
                url: paymentForm.attr('action'),
                data: paymentForm.serialize(),
                dataType: "json",
                beforeSend: function (xhr) {
                    if (paymentForm.valid()) {
                        Common.showSpinner(paymentForm, "Processing...");
                        return true;
                    } else {
                        return false;
                    }
                }
            };
            $.ajax(ajaxOptions).done(function (response) {
                Common.hideSpinner(paymentForm);
                if (response.status === 200) {
                    IPay.resetPayForm();
                    window.open(response.data.authorization_url,"_blank");
                    // Common.showMessage(response.msg);
                } else {

                    Common.onError("Something Went Wrong,try again");
                }
            }).always(function (xhr) {
                Common.hideSpinner(paymentForm);
            }).fail(function (xhr, textStatus, error) {
                Common.hideSpinner(paymentForm);
                if (textStatus !== "canceled") {
                    Common.onError("Sorry An Error Occured Whiles Processing The Request. Kindly Try Again Later.");
                }
            });
        },
        resetPayForm:function () {
            // $("#payment-form")[0].reset();
            paymentForm[0].reset();
            // paymentModal.modal('hide');
            // IPay.refreshDT();
        },
       validateForm: function () {
            Common.validateForm(paymentForm, {
                amount: {
                    required: true,
                    currency: ['$', false]
                },

            }, {});
        }
    };
}();

$(function () {
    IPay.init();
});
