

            $(document).ready(function () {
                $("#idNo").keyup(function () {
                                if ($(this).val().length == 4) {
                                    $(this).val($(this).val() + "-");
                                }
       
                            });
            });
             $(document).ready(function () {
                $("#PhoneNo").keyup(function () {
                                if ($(this).val().length == 4) {
                                    $(this).val($(this).val() + "-");
                                }
                                else if ($(this).val().length == 8) {
                                    $(this).val($(this).val() + "-");
                                }
       
                            });
            });
