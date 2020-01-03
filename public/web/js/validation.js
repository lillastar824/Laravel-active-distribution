
/*login form validation*/
$('#signup').validate({ 
rules: {
    email: {
        required: true,
        email: true
    },
    password: {
        required: true,
        minlength: 8
    },
    confirmPassword: {
        required: true,
        minlength: 8,
         equalTo: "#password"
    }
},
messages: 
        {
        email: {
        required: "Please Enter email address",
        },
        password: {
        required: "Please Enter password",
        },
        confirmPassword: {
        required: "Please Enter Confirm Password",
        equalTo:"Confirm Password should be same as new password"
        }
        }
});



/*change password validation*/
$('#login').validate({ 
rules: {
    email: {
        required: true,
        email: true
    },
    password: {
        required: true,
    },
},
 messages: 
        {
        email: {
        required: "Please Enter Email Address",
        },
        password: {
        required: "Please Enter Password",
        }
        }
});



/*Add Hash Tag Validation*/
$('#editProfile').validate({ 
rules: {
  email: {
        required: true,
        email:true
    }
    ,
    phone: {
        required: true,
        number:true,
        maxlength: 10
    }
    ,
    address: {
        required: true
    }
    ,
    zipcode: {
        required: true,
        number:true,
        maxlength: 6
    },
    file: {
    extension: "jpg|png"
    }
    
},
 messages: 
        {
      
        email: {
        required: "Please Enter an Email",
        }
        ,
        phone: {
        required: "Please Enter Phone Number",
        }
        ,
        address: {
        required: "Please Enter Address",
        }
        ,
        zipcode: {
        required: "Please Enter Zipcode",
        }
        
        }
});






/*Add Hash Tag Validation*/
$('#register').validate({ 
rules: {
    
    phone: {
        required: true,
        number:true,
        maxlength: 10
    }
    ,
    address: {
        required: true
    }
    ,
    zipcode: {
        required: true,
        number:true,
        maxlength: 6
    },
   companyname: {
        required: true
    },
    file: {
    required: true,
    extension: "jpg|png"
    }

  
},
 messages: 
        {
        
        phone: {
        required: "Please Enter Phone Number",
        }
        ,
        address: {
        required: "Please Enter Address",
        }
        ,
        zipcode: {
        required: "Please Enter Zipcode",
        }
        ,
        companyname: {
        required: "Please Enter Company Name",
        }
       
        }
});




/*Add Hash Tag Validation*/
$('#contactus').validate({ 
rules: {
    companyname: {
        required: true,
    },
    email: {
        required: true,
        email:true
    }
    ,
    phone: {
        required: true,
        number:true
    }
    ,
    address: {
        required: true
    }
    ,
    markit_distribution : {
        required: true
    }
    ,
    message: {
        required: true
    }
},
 messages: 
        {
        companyname: {
        required: "Please Enter Company Name",
        },
        email: {
        required: "Please Enter Email",
        },
        phone: {
        required: "Please Enter Phone Number",
        }
        ,
        markit_distribution : {
        required: "Please Enter this Field",
        }
        ,
        message: {
        required: "Please Enter Message",
        }
        }
});






/*Add Hash Tag Validation*/
$('#addCustomer').validate({ 
rules: {
    name: {
        required: true,
    },
    
    zipcode: {
        required: true,
        number:true,
    },

     address: {
        required: true,
       
    },

     flyerCount: {
        required: true,
        number:true,
       
    }
    

},
 messages: 
        {
        name: {
        required: "Please Enter Name",
        },

       
        zipcode: {
        required: "Please Enter Zipcode Number",
        }
        ,
        address: {
        required: "Please Enter Address",
        },
        flyerCount: {
        required: "Please Enter Flyer Count",
        }
        
        }
});





/*Add Hash Tag Validation*/
$('#changeForgotPassword').validate({ 
rules: {
    password: {
        required: true,
    },
    confirm_password: {
        required: true,
        equalTo: "#password"
    }
},
 messages: 
        {
        password: {
        required: "Please Enter password",
        },

        confirm_password: {
        required: 'Please enter confirm password',
        equalTo:'Confirm password must be same as password'
        
    }
        
}
});






