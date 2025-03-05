//<editor-fold  defaultstate="collapsed" desc="Common Functions">

var Common = function () {
    var API_BASE_URL = "";
    var BASE_IMAGE_PATH = "";

    return {
        getBasePath: function () {
            return BASE_IMAGE_PATH;
        },
        getBaseUrl: function () {
            return API_BASE_URL;
        },

        formatDateMoment: function (date) {
            try {
                return moment(date).format('DD-MM-YYYY hh:mm:ss');
            } catch (e) {
                return date;
            }
        },
        capitalize: function (txt) {
            return txt.charAt(0).toUpperCase() + txt.slice(1).toLowerCase();
        },
        formatDate: function (date) {
            try {
                var currentDt = new Date(date);
                var mm = currentDt.getMonth() + 1;
                var dd = currentDt.getDate();
                var yyyy = currentDt.getFullYear();
                var formattedDate = dd + '/' + mm + '/' + yyyy;
                return formattedDate;
            } catch (err) {
                return date;
            }
        },

        isBlank: function (str) {
            return (!str || /^\s*$/.test(str));
        },

        isEmpty: function (str) {
            return (!str || 0 === str.length || Common.isBlank(str));
        }
        ,
        resetForm: function ($form, action) {
            $form.resetForm();
            $form.clearForm();
            if (action != null) {
                action();
            }
        }
        ,
        showSpinner: function (UIElement, msg) {
            UIElement.block({
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                },
                // overlayCSS: {backgroundColor: '#00f'},
                message: msg
            });
        }
        ,
        hideSpinner: function (UIElement) {
            UIElement.unblock();
        }
        ,
        confirmAction: function (msg, okAction, cancelAction) {
            swal({
                title: "Are you sure?",
                text: msg,
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }, function (willAct) {
                if (willAct) {
                    okAction();
                } else {
                    if (cancelAction != null) {
                        cancelAction();
                    } else {
                        Common.onWarn("Action Not Taken :)");
                    }
                }
            });
        }
        ,
        showMessage: function (msg) {
            swal({
                title: "Good job!",
                text: msg,
                type: "success"
            });
        }
        ,
        onError: function (msg) {
            swal({
                title: "Ooops!",
                text: msg,
                type: "error"
            });
        }
        ,
        onWarn: function (msg) {
            swal({
                title: ":)",
                text: msg,
                type: "warning"
            });
        }
        ,
        validateForm: function (form, rules, msgs) {
            $.validator.addMethod("noWhiteSpace", function (value, element) {
                return value == '' || value.trim().length != 0;
            }, "No leading spaces please and don't leave it empty");
            $.validator.addMethod("noSpace", function (value, element) {
                return value.indexOf(" ") < 0 && value != "";
            }, "No space please and don't leave it empty");
            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            });
            $.validator.addMethod("greaterThan",
                function (value, element, params) {

                    if (!/Invalid|NaN/.test(new Date(value))) {
                        return new Date(value) > new Date($(params).val());
                    }

                    return isNaN(value) && isNaN($(params).val())
                        || (Number(value) > Number($(params).val()));
                }, 'Must be greater than {0}.');

            var options = {
                ignore: ":hidden:not(.selectpicker)",
                rules: rules,
                messages: msgs,
                errorElement: "em",
                errorClass: "text-danger",
                // onkeyup: false, //turn off auto validate whilst typing
                //onfocusout: false,
                errorPlacement: function (error, element) {
                    $(element).closest('div').addClass('has-error');
                    if (element.hasClass('bs-select')) {
                        error.insertAfter('.bootstrap-select');
                    } else if (element.is(':checkbox')) {
                        error.insertAfter('.checkbox');
                    }
                    else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".form-group").addClass("has-error").removeClass("has-success");

                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".form-group").addClass("has-success").removeClass("has-error");

                }
            };
            return form.validate(options);
        }
        ,
        formToJSON: function (elements) {
            try {
                return [].reduce.call(elements, function (data, element) {
                        data[element.name] = element.value;
                        return data;

                    },
                    {}
                )
                    ;
            } catch (e) {

            }
        }
        ,
        loadDataInToSelect: function (selectField, selectData, keyId, keyName) {
            var data = $.map(selectData, function (obj) {
                obj.text = obj.text || obj[keyName]; // replace name with the property used for the text
                obj.id = obj.id || obj[keyId]; // replace pk with your identifier
                return obj;
            });
            if (data.length > 0) {
                selectField.find('option').not(':first').remove();
                selectField.val(null).trigger("change");
                selectField.select2({data: data});
            }
        }
        ,

        clearSelectField: function (selectField) {
            selectField.find('option').not(':first').remove();
            selectField.val(null).trigger("change");
        }
        ,
        checkEmptyObj: function (data) {
            $.each(data, function (key, value) {
                if ($.isPlainObject(value) || $.isArray(value)) {
                    checkEmptyObj(value);
                }
                if (value === "" || value === null || $.isEmptyObject(value)) {
                    delete data[key];
                }
            });

        }
        ,
        populateDropDown: function (dropDownEl, items, keyId, keyName) {
            // dropDownEl.empty();
            // dropDownEl.append(new Option("Choose", "", true, true));
            items.forEach(function (item) {
                dropDownEl.append(new Option(item[keyName], item[keyId], false, false));
            });
            // dropDownEl.select2({
            //     width: '100%'
            // });
        }
        ,
        loadDataToDropDown: function (dropDownEl, keyId, keyName, endPoint) {
            $.ajax({
                type: "GET",
                url: endPoint,
                dataType: "json",
                beforeSend: function (xhr) {
                    // Common.showSpinner(appForm, "loading data...");
                    return true;
                }
            }).done(function (response) {
                if (response.code === 200) {
                    var items = (response.data != null) ? response.data : [];
                    Common.populateDropDown(dropDownEl, items, keyId, keyName);
                }

            }).always(function (response) {
                //  Common.hideSpinner(appForm);
            }).fail(function (xhr) {
                //  Common.hideSpinner(appForm);
            });
        }
        ,

        loadData: function (endpoint, resultCallBack) {
            $.ajax({
                type: "GET",
                url: endPoint,
                dataType: "json",
                beforeSend: function (xhr) {
                    Common.showSpinner(appForm, "loading data...");
                    return true;
                }
            }).done(function (response) {
                if (response.code === RES_STATUS.GET) {
                    var items = (response.data != null) ? response.data : [];
                    resultCallBack(items);
                }

            }).always(function (response) {
                Common.hideSpinner(appForm);
            }).fail(function (xhr) {
                Common.hideSpinner(appForm);
            });
        }
        ,

        submitForm: function (requestType, requestUrl, successCallBack) {
            var record = Common.formToJSON(appForm[0].elements);// userForm.serializeObject();//userForm.serialize() + "&userId=" + user.id + "&businessId=" + user.businessId;
            $.ajax({
                type: requestType,
                url: requestUrl,
                contentType: 'application/json; charset=utf-8',
                dataType: "json",
                data: JSON.stringify(record),
                beforeSend: function (xhr) {
                    if (appForm.valid()) {
                        Common.showSpinner(appForm, "Saving Information...");
                        return true;
                    } else {
                        return false;
                    }
                }
            }).done(function (response) {
                if (response.code === RES_STATUS[requestType]) {
                    Common.showMessage(response.message);
                    successCallBack();
                } else {
                    Common.onError(response.message);
                }

            }).always(function (response) {
                Common.hideSpinner(appForm);
            }).fail(function (xhr) {

            });
        }
        ,
        storeUserSession: function (user) {
            if (window.sessionStorage) {
                if (user != null) {
                    sessionStorage.setItem("profile", JSON.stringify(user));
                } else {
                    sessionStorage.setItem("profile", null);
                }
            } else {
                Common.onError("Session Initialization Failed");
                Common.redirectToLogin();
            }
        }
        ,
        updateUserSession: function () {
            var user = Common.getLoggedInUser();
            user.name = $("#accountName").val();
            user.email = $("#accountEmail").val();
            user.phoneNo = $("#accountPhone").val();
            // user.username = $("#accountUserName").val();
            // user.password = $("#accountPassword").val();
            Common.storeUserSession(user);
        }
        ,

        init: function () {

            try {
                $.ajaxSetup({
                    headers: {'group-id': Common.getLoggedInUser().groupId}
                    // beforeSend: function (xhr) {
                    //     xhr.setRequestHeader('deq-pay', AppManager.getLoggedInUser().authToken);
                    // }
                });

            } catch (e) {
                Common.redirectToLogin();
            }
        }
        ,

        formatAmount: function(value) {
            //var value= $("#field1").val();
            var regex = /^[1-9]\d*(((,\d{3}){1})?(\.\d{0,2})?)$/;
            if (regex.test(value))
            {
                //Input is valid, check the number of decimal places
                var twoDecimalPlaces = /\.\d{2}$/g;
                var oneDecimalPlace = /\.\d{1}$/g;
                var noDecimalPlacesWithDecimal = /\.\d{0}$/g;

                if(value.match(twoDecimalPlaces ))
                {
                    //all good, return as is
                    return value;
                }
                if(value.match(noDecimalPlacesWithDecimal))
                {
                    //add two decimal places
                    return value+'00';
                }
                if(value.match(oneDecimalPlace ))
                {
                    //ad one decimal place
                    return value+'0';
                }
                //else there is no decimal places and no decimal
                return value+".00";
            }
            return null;
        },

        initToolTips: function () {
            $("button").tooltip();
            $("a").tooltip();
            $("input").tooltip();
            $("img").tooltip();
        }
    }
}
();


//</editor-fold>

$(function () {

});
