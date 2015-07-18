$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    emailregex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    $("#login-form").submit(function (event) {
        event.preventDefault();
        cnp = $("#login-form input[name=cnp]").val();
        email = $("#login-form input[name=email]").val();
        parola = $("#login-form input[name=parola]").val();
        val = 0;
        $("#login-form .alert").slideUp(function () {
            if (cnp.length != 13 && !/^\d+$/.test(cnp)) {
                $("#login-form .alert").html("<strong>Eroare!</strong> CNP-ul introdus nu este valid!");
                $("#login-form .alert").slideDown();
            } else if (!emailregex.test(email)) {
                $("#login-form .alert").html("<strong>Eroare!</strong> Adresa de email introdusă nu este validă!");
                $("#login-form .alert").slideDown();
            } else if (parola.length < 4) {
                $("#login-form .alert").html("<strong>Eroare!</strong> Parola introdusă este prea scurtă!");
                $("#login-form .alert").slideDown();
            } else {
                $.post("ajax/login", {cnp: cnp, email: email, parola: parola}).done(function (data) {
                    $("#login-form .alert").html('');
                    if (data != 1) {
                        $("#login-form .alert").html('<strong>Eroare!</strong> ' + data + '');
                    } else {
                        $("#login-form .alert").removeClass("alert-danger");
                        $("#login-form .alert").addClass("alert-success");
                        $("#login-form .alert").html('Logat cu succes!');
                        setTimeout(function () {
                            window.location.href = "votare";
                        }, 1000);
                    }
                    $("#login-form .alert").slideDown();
                });
            }
        });
    });
    $('.modal').on('show.bs.modal', function () {
        $(".modal-content").css("height", "65px");
        $(".modal-body").css("display", "none");
    });
    $('.modal').on('shown.bs.modal', function () {
        $(".modal-body").slideDown(250);
        $(".modal-content").css("height", "auto");
    });
    $("#descreditor").summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['codeview', ['codeview']]
        ],
        height: 200
    });

    $("#sesedit-form").submit(function (event) {
        event.preventDefault();
        id = $("#sesedit-form input[name=id]").val();
        titlu = $("#sesedit-form input[name=titlu]").val();
        idata = $("#sesedit-form input[name=idata]").val();
        iora = $("#sesedit-form input[name=iora]").val();
        fdata = $("#sesedit-form input[name=fdata]").val();
        fora = $("#sesedit-form input[name=fora]").val();
        descr = $("#descreditor").code();

        $("#sesedit-form .alert").slideUp(function () {
            if (titlu.length < 2) {
                $("#sesedit-form .alert").html("<strong>Eroare!</strong> Introduceți un titlu!");
                $("#sesedit-form .alert").slideDown();
            } else if (!/^[0-9][0-9]\-[0-9][0-9]\-[1-3][0-9][0-9][0-9]$/.test(idata)) {
                $("#sesedit-form .alert").html("<strong>Eroare!</strong> Data începerii nu este formatată corect!");
                $("#sesedit-form .alert").slideDown();
            } else if (!/^[0-9][0-9]\-[0-9][0-9]\-[1-3][0-9][0-9][0-9]$/.test(fdata)) {
                $("#sesedit-form .alert").html("<strong>Eroare!</strong> Data încheierii nu este formatată corect!");
                $("#sesedit-form .alert").slideDown();
            } else if (!/^[0-2][0-9]\:[0-6][0-9]\:[0-6][0-9]$/.test(iora)) {
                $("#sesedit-form .alert").html("<strong>Eroare!</strong> Ora începerii nu este formatată corect!");
                $("#sesedit-form .alert").slideDown();
            } else if (!/^[0-2][0-9]\:[0-6][0-9]\:[0-6][0-9]$/.test(fora)) {
                $("#sesedit-form .alert").html("<strong>Eroare!</strong> Ora încheierii nu este formatată corect!");
                $("#sesedit-form .alert").slideDown();
            } else {
                if (id == "new") {
                    url = "adaugare";
                } else {
                    url = "editare";
                }
                $.post("ajax/" + url + "-ses", {id: id, titlu: titlu, descr: descr, idata: idata, iora: iora, fdata: fdata, fora: fora}).done(function (data) {
                    $("#sesedit-form .alert").html('');
                    if (data != 1) {
                        $("#sesedit-form .alert").html('<strong>Eroare!</strong> ' + data);
                    } else {
                        $("#sesedit-form .alert").removeClass("alert-danger");
                        $("#sesedit-form .alert").addClass("alert-success");
                        if (id == "new") {
                            $("#sesedit-form .alert").html('Adăugat cu succes!');
                        } else {
                            $("#sesedit-form .alert").html('Modificat cu succes!');
                        }
                        setTimeout(function () {
                            window.location.href = "admin-bec";
                        }, 1000);
                    }
                    $("#sesedit-form .alert").slideDown();
                });
            }
        });
    });

    $("#delsesbut").click(function (event) {
        event.preventDefault();
        id = $("#sesedit-form input[name=id]").val();
        $.post("ajax/del-ses", {id: id}).done(function (data) {
            if (data == "1") {
                window.location.href = "admin-bec";
            } else {
                alert(data);
            }
        });
    });

    $("#candedit-form").submit(function (event) {
        event.preventDefault();
        id = $("#candedit-form input[name=id]").val();
        sid = $("#candedit-form input[name=sid]").val();
        nume = $("#candedit-form input[name=nume]").val();
        descr = $("#descreditor").code();

        $("#candedit-form .alert").slideUp(function () {
            if (nume.length < 2) {
                $("#candedit-form .alert").html("<strong>Eroare!</strong> Introduceți un nume!");
                $("#candedit-form .alert").slideDown();
            } else {
                if (id == "new") {
                    url = "adaugare";
                    id = sid;
                } else {
                    url = "editare";
                }
                $.post("ajax/" + url + "-cand", {id: id, nume: nume, descr: descr}).done(function (data) {
                    $("#candedit-form .alert").html('');
                    if (data != 1) {
                        $("#candedit-form .alert").html('<strong>Eroare!</strong> ' + data);
                    } else {
                        $("#candedit-form .alert").removeClass("alert-danger");
                        $("#candedit-form .alert").addClass("alert-success");
                        if (url == "adaugare") {
                            $("#candedit-form .alert").html('Adăugat cu succes!');
                        } else {
                            $("#candedit-form .alert").html('Modificat cu succes!');
                        }
                        setTimeout(function () {
                            window.location.href = "admin-bec/candidati/" + sid;
                        }, 1000);
                    }
                    $("#candedit-form .alert").slideDown();
                });
            }
        });
    });

    $("#delcandbut").click(function (event) {
        event.preventDefault();
        id = $("#candedit-form input[name=id]").val();
        sid = $("#candedit-form input[name=sid]").val();
        $.post("ajax/del-cand", {id: id}).done(function (data) {
            if (data == "1") {
                window.location.href = "admin-bec/candidati/" + sid;
            } else {
                alert(data);
            }
        });
    });

    $("#imgformdata").submit(function (event) {
        event.preventDefault();
        $("#img-modal .uplprogress").slideDown();
        id = $("#candedit-form input[name=id]").val();
        $("#img-modal input[type=submit]").addClass("disabled");
        $("#img-modal input[type=submit]").attr("value", "Încărcare...");
        setTimeout(function () {
            var formData = new FormData($("#imgformdata")[0]);
            $.ajax({
                url: 'ajax/img-cand/'+id,
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    $("#img-modal .uplprogress").slideUp();
                    $("#img-modal input[type=submit]").removeClass("disabled");
                    $("#img-modal input[type=submit]").attr("value", "Trimite");
                    if (data != 1) {
                        $("#img-modal .modmsg").html('');
                        $("#img-modal .modmsg").css("display", "none");
                        $("#img-modal .modmsg").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> ' + data + '</div>');
                        $("#img-modal .modmsg").slideDown();
                    } else {
                        $("#img-modal .modmsg").html('');
                        $("#img-modal .modmsg").css("display", "none");
                        $("#img-modal .modmsg").html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> Imagine setată cu succes!</div>');
                        $("#img-modal .modmsg").slideDown();
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }, 1000);
    });


    $("#persadd-form").submit(function (event) {
        event.preventDefault();
        cnp = $("#persadd-form input[name=cnp]").val();
        nume = $("#persadd-form input[name=nume]").val();
        nastere = $("#persadd-form input[name=nastere]").val();
        email = $("#persadd-form input[name=email]").val();
        check = $("#persadd-form input[name=check]").is(':checked') ;

        $("#persadd-form .alert").slideUp(function () {
            if (cnp.length != 13) {
                $("#persadd-form .alert").html("<strong>Eroare!</strong> CNP invalid!");
                $("#persadd-form .alert").slideDown();
            } else if (!/^[0-9][0-9]\-[0-9][0-9]\-[1-3][0-9][0-9][0-9]$/.test(nastere)) {
                $("#persadd-form .alert").html("<strong>Eroare!</strong> Data nașterii nu este formatată corect!");
                $("#persadd-form .alert").slideDown();
            } else if (!/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(email)) {
                $("#persadd-form .alert").html("<strong>Eroare!</strong> Adresa de e-mail introdusă nu este corectă!");
                $("#persadd-form .alert").slideDown();
            } else if (!check) {
                $("#persadd-form .alert").html("<strong>Eroare!</strong> Nu ați acceptat regulamentul!");
                $("#persadd-form .alert").slideDown();
            } else {
                $.post("ajax/adaugare-pers", {cnp: cnp, nume: nume, nastere: nastere, email: email}).done(function (data) {
                    $("#persadd-form .alert").html('');
                    if (data != 1) {
                        $("#persadd-form .alert").html('<strong>Eroare!</strong> ' + data);
                    } else {
                        $("#persadd-form .alert").removeClass("alert-danger");
                        $("#persadd-form .alert").addClass("alert-success");
                        $("#persadd-form .alert").html('Adăugat cu succes!');
                        setTimeout(function () {
                            window.location.href = "admin-prim/adaugare/";
                        }, 2000);
                    }
                    $("#persadd-form .alert").slideDown();
                });
            }
        });
    });

    $("#persres-form").submit(function (event) {
        event.preventDefault();
        cnp = $("#persres-form input[name=cnp]").val();
        email = $("#persres-form input[name=email]").val();
        check = $("#persres-form input[name=check]").is(':checked') ;

        $("#persres-form .alert").slideUp(function () {
            if (cnp.length != 13) {
                $("#persres-form .alert").html("<strong>Eroare!</strong> CNP invalid!");
                $("#persres-form .alert").slideDown();
            } else if (!/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(email)) {
                $("#persres-form .alert").html("<strong>Eroare!</strong> Adresa de e-mail introdusă nu este corectă!");
                $("#persres-form .alert").slideDown();
            } else if (!check) {
                $("#persres-form .alert").html("<strong>Eroare!</strong> Nu ați acceptat regulamentul!");
                $("#persres-form .alert").slideDown();
            } else {
                $.post("ajax/resetare-pers", {cnp: cnp, email: email}).done(function (data) {
                    $("#persres-form .alert").html('');
                    if (data != 1) {
                        $("#persres-form .alert").html('<strong>Eroare!</strong> ' + data);
                    } else {
                        $("#persres-form .alert").removeClass("alert-danger");
                        $("#persres-form .alert").addClass("alert-success");
                        $("#persres-form .alert").html('Parolă resetată cu succes!');
                        setTimeout(function () {
                            window.location.href = "admin-prim/resetare/";
                        }, 2000);
                    }
                    $("#persres-form .alert").slideDown();
                });
            }
        });
    });

    $("#urna-form").submit(function(event){
        event.preventDefault();
        cnp = $.trim($("#urna-form input[name=cnp]").val());
        sid = $("#urna-form input[name=sid]").val();
        $("#urna-form .alert").slideUp(function(){
            if (cnp.length != 13) {
                $("#urna-form .alert").removeClass("alert-danger alert-success").addClass("alert-danger");
                $("#urna-form .alert").html("<strong>Eroare!</strong> CNP invalid!");
                $("#urna-form .alert").slideDown();
            }else{
                $.post("ajax/urna-pers", {sid: sid, cnp: cnp}).done(function (data) {
                    //Primul caracter al sirului returnat este 1 sau 0 si reprezinta tipul raspunsului: eroare/succes
                    tipr = data.substring(0, 1);
                    data = data.substring(1, data.length);
                    if(tipr=="1"){
                        $("#urna-form .alert").removeClass("alert-danger alert-success").addClass("alert-success");
                        $("#urna-form .alert").html(data);
                    }else{
                        $("#urna-form .alert").removeClass("alert-danger alert-success").addClass("alert-danger");
                        $("#urna-form .alert").html("<strong>Atenție!</strong> "+data);
                    }
                    $("#urna-form .alert").slideDown();
                });
            }
        });
    });
});
function urna_adaug(event, cnp){
    event.preventDefault();
    sid = $("#urna-form input[name=sid]").val();
    $("#urna-form .alert").slideUp(function(){
        $.post("ajax/urna-adaug", {sid: sid, cnp: cnp}).done(function (data) {
            if(data==1&&cnp.length==13){
                $("#urna-form .alert").removeClass("alert-danger alert-success").addClass("alert-success");
                $("#urna-form .alert").html("Votul persoanei cu CNP-ul <strong>"+cnp+"</strong> a fost înregistrat!");
                $("#urna-form input[name=cnp]").val("");
            }else{
                $("#urna-form .alert").removeClass("alert-danger alert-success").addClass("alert-danger");
                $("#urna-form .alert").html("<strong>Eroare!</strong> "+data);
            }
            $("#urna-form .alert").slideDown();
        });
    });
}
