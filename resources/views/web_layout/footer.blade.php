<!-- start footer here -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <aside class="col-md-7 d-flex justify-content-md-start justify-content-center">
                    <ul class="footer-links">
                        <li><a href="{{asset('getStaticPages/termsAndConditions')}}">Terms & Conditions</a></li>
                        <li><a href="{{asset('getStaticPages/privacyPolicy')}}">Privacy Policy</a></li>
                        <li><a href="#">Become an Employee</a></li>
                        <li><a href="{{asset('getStaticPages/aboutUs')}}">About US</a></li>
                        <li><a href="{{asset('contact-us')}}">Contact Us</a></li>
                    </ul>
                </aside>
                <aside class="col-md-5 d-flex justify-content-md-end justify-content-center">
                    <ul class="social-links">
                        <li><a href="#"><img src="{{asset('public/web')}}/images/facebook_icon.png" alt="" /></a></li>
                        <li><a href="#"><img src="{{asset('public/web')}}/images/twitter_icon.png" alt="" /></a></li>
                        <li><a href="#"><img src="{{asset('public/web')}}/images/google_icon.png" alt="" /></a></li>
                        <li><a href="#"><img src="{{asset('public/web')}}/images/linkedin_icon.png" alt="" /></a></li>
                    </ul>
                </aside>
            </div>
            <p class="text-center">&copy; 2018 Activ Flyer Distribution </p>
        </div>
    </footer>
<!-- end footer here -->
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
<!-- jquery files-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('public/web')}}/js/popper.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="{{asset('public/web')}}/js/validate.js" type="text/javascript"></script>
<script src="{{asset('public/web')}}/js/validation.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>



<script type="text/javascript">
    $(window).scroll(function() {
        if($(this).scrollTop()>300) {
            $( ".header" ).addClass("fixed-me");
        } else {
            $( ".header" ).removeClass("fixed-me");
        }
    });
</script>

<script type="text/javascript">

    $("#emaildatatoggel").change(function(){
    if($(this).prop("checked") == true){
       var vartoggelvalue='1';
       var user_id  = $('#getclientuser_id').val();
    }else{
       var vartoggelvalue='0';
       var user_id  = $('#getclientuser_id').val();
    }
   // alert(user_id);
        $.ajax({
        type:"POST",
        url: "<?php echo url('/emailnotidatatoggel')?>",
        data: {vartoggelvalue: vartoggelvalue, user_id: user_id,"_token": "{{ csrf_token() }}"},
        dataType: 'json',
        async:false,
        cache:false,
        success: function (res) {
          console.info(res);
                   
    }
  });
});
</script>

<script>
        function myjob_name() {
            document.getElementById("myjobconversion").value = document.getElementById("totalseatsTyps").value;
        }
</script>

<script type="text/javascript">
      $(document).ready(function() {
     /*   $('.datetimepicker13').datetimepicker({
            format: 'dd/mm/yyyy'
       });*/

       $(function () {
  $("#datetimepicker13").datepicker({ 
        autoclose: true, 
        todayHighlight: true,
         startDate: '-0d',
  }).datepicker('update', new Date());
});
   });
</script>

<script type="text/javascript">
  $("#addNewCustomer").validate({
    rules: {
      myjobb_name:{ 
          required: true
          
    },
      name: {
         required: true
    
   },
   lastname: {
         required: true
    
   },
   zipcode: {
         required: true
    
   },
   address: {
         required: true
    
   }, 
    phone: {
        required: true,
        maxlength: 20,
        number: true
    }, 
    email: {
         required: true
    
   },
    flyerdate: {
         required: true
    
   },
    flyerCount: {
         required: true
     }
  },

    messages: {
        myjobb_name: {
            required: "Please Select Job Name"
        },
        name: {
            required: "Please Enter First Name"
        },
        lastname: {
            required: "Please Enter Last Name"
        },
        zipcode: {
            required: "Please Enter Zipcode"
        },
        address: {
            required: "Please Enter Address"
        },
        phone: {
            required: "Please Enter Phone Number"
        },
        email: {
            required: "Please Enter Email Address"
        },
        flyerdate: {
            required: "Please Select Date"
        },
        flyerCount: {
            required: "Please Enter Flyers Number"
        }
    }

        });

   
 $.validator.addMethod( "nowhitespace", function( value, element ) {
    return this.optional( element ) || /^\S+$/i.test( value );
    }, "No white space please" );


</script>

<script type="text/javascript">
  $("#gps_job").validate({
    rules: {
      myjobb_name:{ 
          required: true
          
    }
  },

    messages: {
        myjobb_name: {
            required: "Please Select Job Name"
        }    }

        });

   
 $.validator.addMethod( "nowhitespace", function( value, element ) {
    return this.optional( element ) || /^\S+$/i.test( value );
    }, "No white space please" );


</script>
<!-- jquery files-->
</body>
</html>
