window.onload=function(){
        $('.poll').click(function(){
            if($("input:checked" ).length!=4){
                alert("Every question must be answered!")
                console.log("Sgs")
                $('.poll').after("Every question must be answered!")
                return false;
            }
            else{
                alert("Thank you for feedback!")
                return true;

            }
            
            })  
   if(location.href.includes("insertProduct.php")){ 
        document.getElementById('tabela').innerHTML="";
        let ispis=`
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Insert product</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>`;
                      Ajax("../../logic/prikaz.php", "POST","", function(data){
                          console.log(data)
                          let nazivi=Object.keys(data[0])
                ispis+=`<input type="hidden" value="null" id="${nazivi[0]}"/>
                <div class="form-row">`
                for(i=1;i<nazivi.length;i++){
                    if(nazivi[i]=="QualityCheck" || nazivi[i]=="Availability"){
                        ispis+=`  <div class="col-12 my-1 mr-sm-2">
                        <input class="check" type="checkbox" id="${nazivi[i]}" value="${nazivi[i]}" name="${nazivi[i]}" >
                        <label class=""  for="customControlInline">${nazivi[i]}</label>
                      </div>`
                    }
                    else if(nazivi[i]=="Datum" || nazivi[i]=="NazivKat"){
                        continue;
                    }
                    else{
                        ispis+=`<div class="col-7">
                        <input type="text" id="${nazivi[i]}" class="form-control polja" name="${nazivi[i]}" placeholder="${nazivi[i]}">
                      </div>`
                    }
                   
                }
                
                          ispis+=`
                          <div class="form-row align-items-center">
                            <div class="col-auto my-1">
                              <select class="polja custom-select mr-sm-2" id="IdK">
                                <option selected>Choose category...</option>
                                
                                `
                Ajax("../../logic/selectAll.php", "POST",{tabela:"kategorije"}, function(kat){
                    for(i=1;i<kat.length;i++){
                        ispis+=`<option class="dropdown-item" value="${kat[i].IdK}">${kat[i].NazivKat}</option>`
                    }
                    ispis+=`</select>
            </div>
                    </div>  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary insertProizvoda">Insert</button>
                  </div>   </tbody>
                              </table>
                            </div>
                          </div>
                        </div></div>
                        </div>
                      </div>`
                      document.getElementById('tabela').innerHTML+=ispis;
                      let obj={}
                      $('.insertProizvoda').click(function(){
                       let polja=document.getElementsByClassName("polja")
                       let integer=parseInt($('#Iznos').val());
                       let integer1=parseInt($('#Visina').val())
                       let integer2=parseInt($('#Dubina').val())
                       let integer3=parseInt($('#Tezina').val())
                       let integer4=parseInt($('#Sirina').val())
                       if(!Number.isInteger(integer) || !Number.isInteger(integer1) || !Number.isInteger(integer2) || !Number.isInteger(integer3) || !Number.isInteger(integer4)){
                    alert("Iznos, dubina, sirina, visina, tezina  must be integer!")}
                       for(p of polja){
                           if(p.value=="" || p.value=="Choose category..."){
                               alert("Field cant be empty and you must choose category!")
                               break
                           }
                           else{
                            obj[p.id]=p.value   
                           }
            }
            let check=document.getElementsByClassName("check")
            for(c of check){
                if(c.checked){
                    obj[c.id]=true
                }
                else{
                    obj[c.id]=false
                }
            }

            Ajax("../../logic/insertProizvoda.php","POST",obj,function(data){
                window.location.reload();
                alert(data)
            })
                      })
                     
                      
                         
                })
               })
    }

// $('.poll').click(function(){
//     if($("input:checked" ).length){
//         alert("Every question must be answered!")
//         return false;
//     }
//     else{
//         Ajax("logic/pollInsert.php","POST", {tabela:"anketapitanja"}, function(data){
//             window.location.href="index.php";
//             alert("Thank you for your answer!");
            
            
            
//         })
//     }
    
//     })    
    
 $('.deletePoruka').on("click",poruka)


//aktivna anketa
    if(location.href.includes("dashboard.php")){ 
Ajax("../../logic/selectAll.php","POST", {tabela:"anketapitanja"}, function(data){
    console.log(data)
    for(d of data){
        console.log(d.aktivna)
        if(d.aktivna==1){
$('.custom-switch').html(`  <input type="checkbox" value="" id="customSwitches" checked>
<label class="form-check-label aktivno" for="flexCheckIndeterminate">Poll is active
</label>`)
        }
        else{
            $('.custom-switch').html(`  <input type="checkbox" value="" id="customSwitches">
            <label class="form-check-label aktivno" for="flexCheckIndeterminate">Poll is not active
            </label>`)
        }
    }
$('#customSwitches').click(function(){
    let red=["aktivna"]
    let vrednost=[]
    if($('#customSwitches').is( ':checked' )){
        $('.aktivno').text("Poll is active")
         vrednost=[1]
    }
    else{
        vrednost=[0]
        $('.aktivno').text("Poll is not active")
    }
    Ajax("../../logic/update.php","POST", {id:d.IdAP,tabela:"anketapitanja",nazivKolone:"IdAP",vrednost:vrednost,red:red}, function(data){
    })

  
})
})
    }



    // if(location.href.includes("insertProduct.php")){ 
    //     document.getElementById('tabela').innerHTML="";
    //     let ispis=`
    //     <div class="container-fluid">
    //       <div class="row">
    //         <div class="col-md-12">
    //           <div class="card">
    //             <div class="card-header card-header-primary">
    //               <h4 class="card-title ">Insert product</h4>
    //             </div>
    //             <div class="card-body">
    //               <div class="table-responsive">
    //                 <table class="table">
    //                   <tbody>`;
    //                 //   IdP	NazivKat	Name	Description	Visina	Tezina	Dubina	Sirina	QualityCheck Availability	Iznos	Datum	alt	src
    //                   Ajax("../../logic/prikaz.php", "POST","", function(data){
    //                       let nazivi=Object.keys(data[0])
    //             ispis+=`<input type="hidden" value="null" id="${nazivi[0]}"
    //             <div class="form-row">
    //             <div class="col-7">
    //               <input type="text" class="form-control" placeholder="${nazivi[2]}">
    //             </div>
    //             <div class="col">
    //               <input type="text" class="form-control" placeholder="${nazivi[3]}">
    //             </div>
    //             <div class="col">
    //               <input type="text" class="form-control" placeholder="${nazivi[4]}">
    //             </div>
    //             <div class="col">
    //             <input type="text" class="form-control" placeholder="${nazivi[7]}">
    //           </div>
    //           <div class="col">
    //             <input type="text" class="form-control" placeholder="${nazivi[6]}">
    //           </div>
    //           <div class="col-7">
    //           <input type="text" class="form-control" placeholder="${nazivi[5]}">
    //         </div>
    //           <div class="col">
    //             <input type="text" class="form-control" placeholder="${nazivi[10]}">
    //           </div>
    //           </div><div class="col">
    //           <input type="hidden" class="form-control" id="${nazivi[11]}" value="null">
    //         </div>
    //         <div class="col">
    //             <input type="text" class="form-control" placeholder="${nazivi[12]}">
    //           </div>
    //           <div class="col">
    //             <input type="text" class="form-control" placeholder="${nazivi[13]}">
    //           </div>
    //           <div class="custom-control custom-checkbox my-1 mr-sm-2">
    //           <input type="checkbox" class="custom-control-input" id="customControlInline">
    //           <label class="custom-control-label" for="customControlInline">${nazivi[8]}</label>
    //         </div>     
    //         <div class="custom-control custom-checkbox my-1 mr-sm-2">
    //         <input type="checkbox" class="custom-control-input" id="customControlInline">
    //         <label class="custom-control-label" for="customControlInline">${nazivi[9]}</label>
    //       </div>       
    //             <div class="dropdown">
    //             <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //               Choose kategory
    //             </button>
    //             <div class="dropdown-menu" aria-labelledby="dropdownMenu2">`
    //             Ajax("../../logic/selectAll.php", "POST",{tabela:"kategorije"}, function(kat){
    //                 for(d of kat){
    //                     ispis+=`<option class="dropdown-item" value="${d.IdK}">${d.NazivKat}</option>`
    //                 }
    //                 ispis+=`
    //         </div>
    //                 </div>   </tbody>
    //                           </table>
    //                         </div>
    //                       </div>
    //                     </div></div>
    //                     </div>
    //                   </div>`
    //                   document.getElementById('tabela').innerHTML+=ispis; 
                         
    //             })
    //           })
    // }





if(location.href.includes("contact.php")){ 

$('.poruka').click(function(e){
    e.preventDefault()
       let tabela="poruka";
    let email=$('#email').val()
        let ime=$('#name').val()
        let regImePrezime=/^[A-Z][a-z]{1,}$/
        let regemail=/^[\w\d\.]+@[a-z]{2,}\.[a-z]{2,3}$/
        let greske=0
        if(!regImePrezime.test(ime) || ime==""){
            greske++;
            $('.alertime').removeClass("d-none");
            $('.alertime').html("Field must contain first capital letter, and youre first name.")
        }
        else{
            $('.alertime').addClass("d-none");
        }
        if(!regemail.test(email) || email==""){
            greske++;
           $('.alertemail').removeClass("d-none");
           $('.alertemail').html("Field must contain @ capital letter.")
        }
        else{
            $('.alertemail').addClass("d-none");
        }
       let polja=document.getElementsByClassName("insertPolje"+tabela);
       let vrednosti=[]

   
   for(p of polja){
       if(p.value!=""){
        vrednosti.push(p.value)
       }
       else{
           greske++
         
       }

   }
   console.log(greske)
if(greske==0){
    Ajax("logic/insertPoruke.php", "POST",{tabela:tabela, vrednosti:vrednosti},function(data){
     alert("dodato!") 
     $("#message").val("")
     $("#subject").val("")
     
     
    })
}
else{alert("Field cant be empty")}

   })

}



    if(location.href.includes("products.php")){
        let ime={0:"proizvod"}
        Ajax("../../logic/prikaz.php", "POST","", function(data){
             console.log(data)
            tabela(data,ime)
        
    })


    }


    if(location.href.includes("users.php")){
        let ime={0:"korisnik"}
        Ajax("../../logic/selectSve.php", "POST","", function(data){
            tabela(data,ime)
        console.log(data)
    })


    }


//insert admina
$(".user").click(function(e){
    e.preventDefault();
    let ime=$('.adminIme').val()
    let prezime=$('.adminPrezime').val()
    let email=$('.adminEmail').val()
    let id=$(".user").attr('id')
    let greske=0;
    let regImePrezime=/^[A-ZČĆŠĐŽ][a-zšđčćž]{1,10}$/
        let regemail=/^[\w\d\.-]+@[a-z]{2,}\.[a-z]{2,3}$/
        if(!regImePrezime.test(ime) || ime==""){
            greske++;
           $('.alertime').removeClass("d-none");
           $('.alertime').html("Field must contain first capital letter.")
        }
        else{
            $('.alertime').addClass("d-none");
        }
        // if(!regImePrezime.test(prezime) || prezime==""){
        //     greske++;
        //    $('.alertprezime').removeClass("d-none");
        //    $('.alertprezime').html("Field must contain first capital letter.")
        // }
        // else{
        //     $('.alertprezime').addClass("d-none");
        // }
        if(!regemail.test(email) || email==""){
            greske++;
           $('.alertemail').removeClass("d-none");
           $('.alertemail').html("Field must contain @ simbol.")
        }
        else{
            $('.alertemail').addClass("d-none");
        }
// console.log(prezime)
if(greske==0){
    let vrednosti=[]
    vrednosti.push(ime)
    vrednosti.push(prezime)
    vrednosti.push(email)
    let red=[]
    red.push("Ime")
    red.push("Prezime")
    red.push("Email")
Ajax("../../logic/update.php", "POST",{nazivKolone:"IdKorisnik",tabela:"korisnik",id:id,red:red,vrednost:vrednosti}, function(data){alert("updated!")})
 }
})


    //komentari u admin panelu-samo delete
    if(location.href.includes("comment.php")){
        var naziv={0:"komentari"}
        Ajax("../../logic/adminKomentari.php", "POST",naziv,function(data){
            console.log(data)
         tabela(data,naziv)
        })
    }


//na pocetnoj random 3 proizvoda top pick
if(location.href.includes("index")){
Ajax("logic/proizvod.php","POST","",function(data){
    
    console.log(data)
   let rand1=""
   // console.log(rand)
    ispis=""
    for(i=0;i<3;i++){
        let rand=Math.floor(Math.random()*data.length);
        //rand=Math.floor(Math.random()*data.length);
        if(rand1==rand){
            rand=Math.floor(Math.random()*data.length);
        }
        // console.log(data[rand].src)
        ispis+=`<div class="col-lg-4 col-md-6 col-sm-6">
        <div class="single-new-arrival mb-50 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
        <div class="popular-img">
        <img src="assets/img/gallery/`+data[rand].src+`" alt="`+data[rand].alt+`">
        </div>
        <div class="popular-caption">
        <h3><a class="proizvod" href="product.php?IdP=`+data[rand].IdP+`">`+data[rand].Name+`</a></h3>
        <span>`+data[rand].Iznos+`</span>
        </div>
        </div>
        </div>
        </div>`;
        rand1=rand;
        //rand2=rand;
    }
    document.getElementById("rand").innerHTML=ispis;

})


}

//upisivanje komentara u bazu
$('#dugmeKomentar').click(function(){
   let email=$('.komentariEmail').val();
   let komentar=$('.komentar').val();
   let id=$('.hidden').val();
   //console.log(email)
   if(komentar!=""){
       Ajax("logic/insertKomentara.php", "POST",{Emailobj:email,komentarobj:komentar,idP:id},function(data){
        $('.obavestenjeKom').text("Your comment is added!");
        $('.komentar').val("");
        // Ajax("logic/jedanproizvod.php","POST","",function(data){
        //     console.log(data)
        // })
       })
   }
   else{
    $('.obavestenjeKom').text("Field comment cant be empty.");
   }
   



})


//logovanje
$('.logButton').click(function(){
    let emailJS=document.getElementById("logEmail").value
    let passJS=document.getElementById("logPass").value
    let greske=0;
    let regemail=/^[\w\d\.-]+@[a-z]{2,}\.[a-z]{2,3}$/
    let regpass=/^.{5,10}$/
        if(!regemail.test(emailJS) || emailJS==""){
            greske++;
           $('.alertemail').removeClass("d-none");
           //document.getElementById("alertemail").innerHTML="Field must contain @ simbol."
           $('.alertemail').html("Field must contain @ simbol.")
        }
        else{
            $('.alertemail').addClass("d-none");
        }
        if(!regpass.test(passJS) || passJS==""){
            greske++;
           $('.alertpass').removeClass("d-none");
           //document.getElementById("alertpass").innerHTML="Field must contain at least 5 characters."
           $('.alertpass').html("Field must contain at least 5 characters.")
        }
        else{
            $('.alertpass').addClass("d-none");
        }
    if(greske==0){
       // alert("gredke")
        let obj={email:emailJS, pass:passJS}
    Ajax("logic/logovanje.php","POST",obj, function(podaci){
        console.log(podaci)
        if(podaci==false){
            //alert("false")
            $('#logEmail').val("")
            $('#logPass').val("")
            $('.sesija').html(`<p>User with this email and password dose not exist.</p>`)

        }
        else{ $('.sesija').html(` `)
        $('#logEmail').val("")
        $('#logPass').val("")
        window.location.href="index.php"
    }

    })}
    // }
    // else{console.log(greske)}
    

})

//ispis proizvoda na strani gallery.php
if(location.href.includes("gallery")){
    Ajax("logic/proizvod.php", "POST","", function(podaci){
        kategorije(podaci)
})

    //stranicenje
    Ajax("logic/stranicenje.php", "POST","", function(podaci){
        let ispis=""
            for(i = 1; i<= podaci; i++){
                    ispis+=`<a href="gallery.php?broj=`+i+`" id="`+i+`" class="border-btn prikazStranicenja">`+i+`</a>`;
                }
                document.getElementById("stranicenje").innerHTML=ispis;
    $(".prikazStranicenja").on("click", function(e){
                    let id=$(this).attr('id')
                    e.preventDefault();
     Ajax("logic/prikazStranicenja.php", "POST",{broj:id, NazivKat:"All"}, function(podaci){
        kategorije(podaci)
                              })
                })

    })


    //search
$('.search').keyup(function(){
    let polje=document.getElementById("form1").value;
    Ajax("logic/search.php", "POST", {vrednost:polje}, function(data){
           document.getElementById("stranicenje").innerHTML=""
     kategorije(data)
    });

})

}





//u admin panelu ispis tabela
if(location.href.includes("tables.php")){
    var obj={0:"menu",
    1:"uloge",
    2:"kategorije"}
    Ajax("../../logic/selectAdminPanel.php", "POST",obj,function(data){tabele(data,obj)
    })
 

}




$('.kat').click(function(){
    var kategorija= $(this).attr('id');
    let objekat={NazivKat:kategorija};
    console.log(objekat)
    Ajax("logic/filtriranje_kat.php", "POST",objekat, function(data){
        //console.log(data)
         kategorije(data)})

    //stranicenje na osnovu izabrane kategorije
    Ajax("logic/stranicenje.php", "POST",objekat, function(podaci){
        let ispis=""
            for(i = 1; i<= podaci; i++){
                    ispis+=`<a href="gallery.php?broj=`+i+`" id="`+i+`" class="border-btn prikazStranicenja">`+i+`</a>`;
                }
                document.getElementById("stranicenje").innerHTML=ispis;
    $(".prikazStranicenja").on("click", function(e){
                    let id=$(this).attr('id')
                    e.preventDefault();
     Ajax("logic/prikazStranicenja.php", "POST",{broj:id, NazivKat:kategorija}, function(podaci){
        kategorije(podaci)
                              })
                })

    })



    // Ajax("logic/stranicenje.php", "POST",objekat, function(podaci){
    //     console.log(objekat)
    //     let ispis=""
    //     for(i = 1; i<= podaci; i++){
    //              ispis+=`<a href="gallery.php?broj=`+i+`" id="`+i+`" class="border-btn prikazStranicenja">`+i+`</a>`;
    //         }
    //         document.getElementById("stranicenje").innerHTML=ispis;
    //         // let id=$(this).attr('id')
    //         $(".prikazStranicenja").on("click", function(e){
    //             let id=$(this).attr('id')
    //             //console.log(kategorija)
    //             e.preventDefault();
    //            Ajax("logic/prikazStranicenja.php", "POST",{broj:id, NazivKat:kategorija}, function(podaci){
    //                                   kategorije(podaci)
    //                                  })
    //                    })
    // })

})

$('#registracija').click(function(){
   // alert("sfgjh")
   let ime=$('#ime').val();
   let prezime=$('#prezime').val()
   let email=$('#email').val()
   let pass=$('#pass').val()
    let g=provera(ime,prezime,email,pass)
    
        // console.log(greske)
        if(g==0){
            let objekat={imeObj:ime,
            prezObj:prezime,
            emailObj:email,
            passObj:pass,
        dugme:true}
            Ajax("logic/registracija.php","POST",objekat,function(data){
                alert(data)
                console.log(data)
                if(data=="You are registered now! Login!"){window.location.href="login.php"}
                //  window.location.href="login.php"
            })
        }
    })}


function Ajax(url, method, data, success){
        $.ajax({url:url,
        method:method,
        data:data,
        dataType:"json",
        success:success,
        error:function(xhr){
            console.error(xhr.status)
            if(xhr.status==500){
                alert("its server error!")
            }
            // if(xhr.status==400)
            //if statusni 500 uradi to i za 404 isto iz baze

}})


}
function kategorije(data){
    console.log(data)
    var blok=document.getElementById("proizvodi");
    let ispis=""
    if(data.length==0){
        ispis=`<div class="col-lg-4 col-md-6 col-sm-6"><div class="single-new-arrival mb-50 text-center"><h3>EMPTY CATEGORY</h3></div></div>`
    }
    else{
    
        for(d of data){
            ispis+=
            `<div class="col-lg-4 col-md-6 col-sm-6"><div class="single-new-arrival mb-50 text-center">
            <div class="popular-img"><img src="assets/img/gallery/${d.src}" alt="${d.alt}"> 
            </div><div class="popular-caption"><h3><a class="proizvod" href="product.php?IdP=${d.IdP}">${d.Name}</a>
            </h3><span>${d.Iznos} $</span></div></div></div>`
        }
    }
        
        blok.innerHTML=ispis;
    }

function provera(ime,prezime,email,pass){
        // let ime=$('#ime').val()
        // let prezime=$('#prezime').val()
        // let email=$('#email').val()
        // let pass=$('#pass').val()
        let regImePrezime=/^[A-ZČĆŠĐŽ][a-zšđčćž]{1,}$/
        let regemail=/^[\w\d\.]+@[a-z]{2,}\.[a-z]{2,3}$/
        // let regpass=/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[\w])$/
        let regpass=/^.{5,}$/
        var greske=0;
        
        if(!regImePrezime.test(ime) || ime==""){
            greske++;
           $('.alertime').removeClass("d-none");
           //document.getElementById("alertime").innerHTML="Field must contain first capital letter."
           $('.alertime').html("Field must contain first capital letter.")
        }
        else{
            $('.alertime').addClass("d-none");
        }
        if(!regImePrezime.test(prezime) || prezime==""){
            greske++;
           $('.alertprezime').removeClass("d-none");
           //document.getElementById("alertprezime").innerHTML="Field must contain first capital letter."
           $('.alertprezime').html("Field must contain first capital letter.")
        }
        else{
            $('.alertprezime').addClass("d-none");
        }
        if(!regemail.test(email) || email==""){
            greske++;
           $('.alertemail').removeClass("d-none");
           //document.getElementById("alertemail").innerHTML="Field must contain @ simbol."
           $('.alertemail').html("Field must contain @ simbol and .")
        }
        else{
            $('.alertemail').addClass("d-none");
        }
        if(!regpass.test(pass) || pass==""){
            greske++;
           $('.alertpass').removeClass("d-none");
           //document.getElementById("alertpass").innerHTML="Field must contain at least 5 characters."
           $('.alertpass').html("Field must contain at least 5 characters.")
        }
        else{
            $('.alertpass').addClass("d-none");
        }
return greske;

}

// function prikaz(e,kategorija){
//     e.preventDefault();
//     console.log(kategorija)
// }
function tabele(data,obj){
    //alert(data)
   var tekst;
    document.getElementById('tabela').innerHTML="";
    let broj=0
    for(d of data){
        console.log(d)
        var ispis=`
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">${obj[broj]}</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <tbody>`;
                 // console.log(d[0])
                  Object.entries(d[broj]).forEach(([key, value])=> ispis+=`<th  class="text-primary">${key}</th>`)
                     for(dd of d){
                         ispis+=`<tr>`
                         Object.entries(dd).forEach(([key, value])=>ispis+=`<td><input type="text" data-kolona="${key}" class=" form-control ${obj[broj]}`+Object.entries(dd)[0][1]+`" value="${value}"></td>`)
                        ispis+=`<td><a class="waves-effect waves-light btn-small update" name="" data-naziv="`+Object.entries(dd)[0][0]+`" data-table="${obj[broj]}" data-id="`+Object.entries(dd)[0][1]+`" id="" href="#">Update</a></td>
                                <td><a class="waves-effect waves-light btn-small delete"  role="" data-naziv="`+Object.entries(dd)[0][0]+`" data-table="${obj[broj]}" data-id="`+Object.entries(dd)[0][1]+`" href="#">Delete</a></td></tr>`;
                                
                            }

                  
    ispis+=`   </tbody>
            </table>
          </div>
           </div>
           
      </div></div>
      </div>
    </div>` 
    
    document.getElementById('tabela').innerHTML+=ispis;
    tekst=`<div class="card"><div class="card-header">
    <h4 class="card-title card-header">Insertuj ${obj[broj]}</h4>
  <form class="m-auto">
 <div class="form-row ">`
for(dd of d){
    Object.entries(dd).forEach(([key, value])=> tekst+=`<div class="col ">
    <input type="text" class=" insertPolja${obj[broj]} form-control" placeholder="${key}">
    </div> `)
    tekst+=`<div class="col"><a data-table="${obj[broj]}" class=" waves-effect waves-light btn-small insert" name="" id="" href="#">Insert</a></div></div></form></div></div>`
    document.getElementById('tabela').innerHTML+=tekst;
    // $('.disable')
    //$( ".dis" ).hasClass("Id").addClass("disabled");
    // console.log($( ".dis" ).hasClass("Id"))
    break;
    
}
broj++;

}
$('.insert').on("click",function(e){
    e.preventDefault();
   let tabela=this.dataset.table;
   let polja=document.getElementsByClassName("insertPolja"+tabela);
   let vrednosti=[]
   let greske=0
   for(i=0;i<polja.length;i++){
       console.log(polja[0].value)
       let integer=parseInt(polja[0].value)
       if(!Number.isInteger(integer)){
    alert("Id must be integer!")
    break;
       }
       if(polja[i].value!=""){
        vrednosti.push(polja[i].value)
       }
       else{
           greske++

       }

   }
if(greske==0){
    Ajax("../../logic/insert.php", "POST",{tabela:tabela, vrednosti:vrednosti, obj:obj},function(data){
        console.log(data)
        tabele(data,obj) })
}
else{alert("Field cant be empty")}
  
   })
$('.delete').on("click",function(e){
    e.preventDefault();
   let idJS=this.dataset.id;
   let tabelaJS=this.dataset.table;
   let nazivKoloneJS=this.dataset.naziv;
   Ajax("../../logic/delete.php", "POST",{id:idJS,tabela:tabelaJS, nazivKolone:nazivKoloneJS,obj:obj},function(data){
      //alert("dfgd")
       tabele(data,obj)
   })
})
                     
$(".update").click(function(e){
    e.preventDefault();
    let id=this.dataset.id;
    let tabela=this.dataset.table;
    let nazivKolone=this.dataset.naziv;
    //let idPolja=$('.'+tabela+id).val();
   polja=document.getElementsByClassName(tabela+id);
   let data={nazivKolone:nazivKolone,
    tabela:tabela,
    id:id,
    red:"",
    vrednost:""};
   let greske=0;
//    let broj=0;
   let red=[]
   let vrednost=[]
      for(p of polja){
       console.log(p)
       if(p.value==""){
           greske++;
           alert("FIELD CANT BE EMPTY")
       }
       else{
           red.push(p.dataset.kolona)
           vrednost.push(p.value)
        
       }   }
       data.red=red;
        data.vrednost=vrednost
       
       console.log(data)
       if(greske==0){
           console.log(data)
       Ajax("../../logic/update.php", "post", data,function(data){alert("updated!")})

       }
}) 
        


}
function tabela(data,naziv){
    document.getElementById('tabela').innerHTML="";
    let broj=0
    let ispis=`
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">${naziv[broj]}</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <tbody>`;
                  Object.entries(data[broj]).forEach(([key, value])=> ispis+=`<th  class="text-primary">${key}</th>`)
                         for(d of data){
                         ispis+=`<tr>`
                         Object.entries(d).forEach(([key, value])=> ispis+=`<td>${value}</td>`)
                        ispis+=`<td><a class="waves-effect waves-light btn-small delete" name="" role="" data-naziv="`+Object.entries(d)[0][0]+`" data-table="${naziv[broj]}" data-id="`+Object.entries(d)[0][1]+`" href="#">Delete</a></td>`;
                        if(naziv[broj]=="korisnik"){
                            console.log(d.IdKorisnik)
                            ispis+=`<td>
                            <button type="button" class="btn btn-primary modall" data-toggle="modal"  data-id="${d.IdKorisnik}" data-target="#exampleModalCenter">
                             Update role for this user
                            </button>
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                 </div>
                                           `;
                                  }
                            }
                       
    ispis+=`   </tbody>
            </table>
          </div>
        </div>
      </div></div>
      </div>
    </div>`
    
    broj++;
    document.getElementById('tabela').innerHTML+=ispis; 
    $('.modall').on("click",function(){
        let id=this.dataset.id;
        console.log(id)
        let ispis=""
        Ajax("../../logic/selectAll.php","POST",{tabela:"uloge"},function(data){
            ispis+=`<select id="select" class="form-select" aria-label="Default select example"> <option value="0">Choose</option>`
                for(d of data){
                    ispis+=` <option value="${d.IdUloga}">${d.Uloga}</option>`
                }
                ispis+=`</select> <div class="modal-footer">
        </div></td></tr>`
                $('.modal-body').html(ispis);
                $('.form-select').change(function(){
        let uloga=this.value;
        if(document.getElementById("select").value=="0"){
            alert("You must choose something!")
        }
                    Ajax("../../logic/updateKorisnikaUloga.php", "POST",{id:id,uloga:uloga},function(data){
                         location.reload();
                         alert("updated!")
                    })

                })
            })
        
   })
    $('.delete').on("click",function(e){
        e.preventDefault();
       let idJS=this.dataset.id;
       let tabelaJS=this.dataset.table;
       let nazivKoloneJS=this.dataset.naziv;
       Ajax("../../logic/delete.php", "POST",{id:idJS,tabela:tabelaJS, nazivKolone:nazivKoloneJS, obj:naziv},function(data){
        tabela(data,naziv)
      
       })
   })

    
}
function poruka(e){
    e.preventDefault();
   let idJS=this.dataset.id;
   let tabelaJS=this.dataset.table;
   let nazivKoloneJS=this.dataset.naziv;
   let obj={0:"poruka"}
   Ajax("../../logic/delete.php", "POST",{id:idJS,tabela:tabelaJS, nazivKolone:nazivKoloneJS,obj:obj},function(data){
       console.log(data)
       let ispis=""
     for(d of data){

ispis+=` <tr>
<td>${d.IdPoruka}</td>
<td>${d.Naslov}</td>
<td>${d.Poruka}</td>
<td>${d.Ime}</td>
<td>${d.Email}</td>
<td><a class="waves-effect waves-light btn-small deletePoruka"  role="" data-naziv="IdPoruka" data-table="poruka" data-id="${d.IdPoruka}" href="#">Delete</a></td>
</tr>`
     }
     document.getElementById("por").innerHTML=ispis;
     $('.deletePoruka').on("click",poruka)

    })}
