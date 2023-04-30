var url = "http://localhost/cloudflareapi";

function editsitebutton(){

    $("#editsitebuton").prop('disabled', true);
    var data = $("#editsiteform").serialize();

    Swal.fire({
        title: 'Site güncellenecektir',
        text: "İşlemi onaylıyor musunuz?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText : 'İptal',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Onaylıyorum, eklensin'
      }).then((result) => {
        if (result.isConfirmed) {

            var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
            
            $.ajax({
                type : "POST",
                url  : url+"/website/editformdata/",
                data : data,
			
                beforeSend: function() {
                    swal.fire({
                        html: '<h3>İşlem yapılıyor...</h3>',
                        showConfirmButton: false,
                        onRender: function() {
                             $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },

                success :function(result){
                    if($.trim(result) == "empty"){
                        
                        swal.fire("Hata","Boş veri gönderemezsiniz...","error");
                        $("#editsitebuton").prop('disabled', false);

                    }else if($.trim(result) == "error"){

                        swal.fire("Hata","Hata oluştu","error");
                        $("#editsitebuton").prop('disabled', false);

                    }else if($.trim(result) == "allready"){

                        swal.fire("Hata","Domain zaten kayıtlı","error");
                        $("#editsitebuton").prop('disabled', false);

                    }else if($.trim(result) == "ok"){
                       
                        swal.fire("Başarılı","İşlem başarılı","success");
                        setTimeout(function(){   
                        window.location.href = url+"/website/list";
                        }, 1000);
                        
                    }
                }
            });

        }
      })

}



function newsitebutton(){

    $("#newsitebuton").prop('disabled', true);
    var data = $("#newsiteform").serialize();

    Swal.fire({
        title: 'Yeni site eklenecektir',
        text: "Bilgilerin doğruluğundan emin misiniz?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText : 'İptal',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Onaylıyorum, eklensin'
      }).then((result) => {
        if (result.isConfirmed) {

            var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
            
            $.ajax({
                type : "POST",
                url  : url+"/website/newdata/",
                data : data,
			
                beforeSend: function() {
                    swal.fire({
                        html: '<h3>İşlem yapılıyor...</h3>',
                        showConfirmButton: false,
                        onRender: function() {
                             $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },

                success :function(result){
                    if($.trim(result) == "empty"){
                        
                        swal.fire("Hata","Boş veri gönderemezsiniz...","error");
                        $("#newsitebuton").prop('disabled', false);

                    }else if($.trim(result) == "error"){

                        swal.fire("Hata","Hata oluştu","error");
                        $("#newsitebuton").prop('disabled', false);

                    }else if($.trim(result) == "allready"){

                        swal.fire("Hata","Domain zaten kayıtlı","error");
                        $("#newsitebuton").prop('disabled', false);

                    }else if($.trim(result) == "ok"){
                       
                        swal.fire("Başarılı","İşlem başarılı","success");
                        setTimeout(function(){   
                        window.location.href = url+"/website/list";
                        }, 1000);
                        
                    }
                }
            });

        }
      })

}

function loginbuttons(){

    
    $("#signinbuttons").prop('disabled', true);

    var data = $("#loginform").serialize();

    $.ajax({
       type : "POST",
       url  : url+"/user/logindata",
       data : data,
       success : function (result) {

           if($.trim(result) == "empty"){

                swal.fire("Hata","Boş alan bıraktınız,hatalı e-posta girdiniz...","error");
                $("#signinbuttons").prop('disabled', false);


           }else if($.trim(result) == "error"){

               swal.fire("Hata","Kullanıcı adı ya da şifre yanlış...","error");
               $("#signinbuttons").prop('disabled', false);


           }else if($.trim(result) == "passive"){

              
               swal.fire("Hata","Kullanıcı pasif durumdadır.","error");
               $("#signinbuttons").prop('disabled', false);


           }else if($.trim(result) == "ok"){

               swal.fire("Başarılı","Başarıyla giriş yaptınız bekleyiniz....","success");
               setTimeout(function(){
                   window.location.href = url+"/home";
               },2000);
               $("#signinbuttons").prop('disabled', false);


           }

       }
    });

}







function newdnsbutton(){

    $("#newdnsbuton").prop('disabled', true);
    var data = $("#newdnsform").serialize();

    Swal.fire({
        title: 'Yeni dns eklenecektir',
        text: "Bilgilerin doğruluğundan emin misiniz?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText : 'İptal',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Onaylıyorum, eklensin'
      }).then((result) => {
        if (result.isConfirmed) {

            var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
            
            $.ajax({
                type : "POST",
                url  : url+"/dns/newdata/",
                data : data,
			
                beforeSend: function() {
                    swal.fire({
                        html: '<h3>İşlem yapılıyor...</h3>',
                        showConfirmButton: false,
                        onRender: function() {
                             $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },

                success :function(result){
                    var parse = JSON.parse(result);
                    swal.fire("Sonuç",parse.message,"info");
                    
                    var form = document.getElementById('newdnsform');
                    var inputs = form.querySelectorAll('input');
                    inputs.forEach(input => {
                        input.value = '';
                    });

                    $("#newdnsbuton").prop('disabled', false);
                        
                    
                }
            });

        }
      })

}






function multibutton(){

    $("#multibuton").prop('disabled', true);
    var data = $("#multiform").serialize();

    Swal.fire({
        title: 'Toplu site eklenecektir',
        text: "Bilgilerin doğruluğundan emin misiniz?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText : 'İptal',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Onaylıyorum, eklensin'
      }).then((result) => {
        if (result.isConfirmed) {

            var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
            
            $.ajax({
                type : "POST",
                url  : url+"/website/multiadd/",
                data : data,
			
                beforeSend: function() {
                    swal.fire({
                        html: '<h3>İşlem yapılıyor...</h3>',
                        showConfirmButton: false,
                        onRender: function() {
                             $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },

                success :function(result){
                    if($.trim(result) == "empty"){
                        
                        swal.fire("Hata","Boş veri gönderemezsiniz...","error");
                        $("#multibuton").prop('disabled', false);

                    }else if($.trim(result) == "error"){

                        swal.fire("Hata","Hata oluştu","error");
                        $("#multibuton").prop('disabled', false);

                    }else if($.trim(result) == "max"){

                        swal.fire("Hata","Aynı anda 10 adet site ekleyebilirsiniz...","error");
                        $("#multibuton").prop('disabled', false);

                    }else if($.trim(result) == "ok"){
                       
                        swal.fire("Başarılı","İşlem başarılı","success");
                        setTimeout(function(){   
                        window.location.href = url+"/website/list";
                        }, 1000);
                        
                    }
                }
            });

        }
      })

}






function registerbutton(){

    
    $("#registerbuton").prop('disabled', true);

    var data = $("#registerform").serialize();

    $.ajax({
       type : "POST",
       url  : url+"/user/registerdata",
       data : data,
       success : function (result) {

           if($.trim(result) == "empty"){

                swal.fire("Hata","Boş alan bıraktınız,hatalı e-posta girdiniz...","error");
                $("#registerbuton").prop('disabled', false);


           }else if($.trim(result) == "error"){

               swal.fire("Hata","Kullanıcı adı ya da şifre yanlış...","error");
               $("#registerbuton").prop('disabled', false);


           }else if($.trim(result) == "allready"){

              
               swal.fire("Hata","E-posta zaten kayıtlı.","error");
               $("#registerbuton").prop('disabled', false);


           }else if($.trim(result) == "ok"){

               swal.fire("Başarılı","Başarıyla kayıt oldunuz bekleyiniz....","success");
               setTimeout(function(){
                   window.location.href = url+"/user/login";
               },2000);
               $("#registerbuton").prop('disabled', false);


           }

       }
    });

}




function profilebutton(){

    
    $("#profilebuton").prop('disabled', true);

    var data = $("#profileform").serialize();

    $.ajax({
       type : "POST",
       url  : url+"/user/profiledata",
       data : data,
       success : function (result) {

           if($.trim(result) == "empty"){

                swal.fire("Hata","Boş alan bıraktınız,hatalı e-posta girdiniz...","error");
                $("#profilebuton").prop('disabled', false);


           }else if($.trim(result) == "error"){

               swal.fire("Hata","Hata oluştu...","error");
               $("#profilebuton").prop('disabled', false);


           }else if($.trim(result) == "allready"){

              
               swal.fire("Hata","E-posta zaten kayıtlı.","error");
               $("#profilebuton").prop('disabled', false);


           }else if($.trim(result) == "ok"){

               swal.fire("Başarılı","Profil güncellendi....","success");
               setTimeout(function(){
                   window.location.reload();
               },2000);
               $("#profilebuton").prop('disabled', false);


           }

       }
    });

}



function addInput() {
    var input = document.createElement("input");
    input.type = "text";
    input.name = "website[]";
    input.classList.add("form-control");
    input.classList.add("mb-4");
    input.placeholder = "Https:// olmadan sadece deneme.com şeklinde giriniz...";
    var container = document.getElementById("input-container");
    container.appendChild(input);
  }