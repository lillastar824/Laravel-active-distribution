
/*login form validation*/
$('#loginForm').validate({ 
rules: {
    email: {
        required: true,
        email: true
    },
    password: {
        required: true,
        minlength: 5
    }
}
});



/*change password validation*/
$('#changePassword').validate({ 
rules: {
    oldPassword: {
        required: true,
    },
    newPassword: {
        required: true,
        minlength: 5
    },
    confirmPassword: {
        required: true,
        equalTo: "#newPassword"
    },
},
 messages: 
        {
        oldPassword: {
        required: "Please Enter Old Password",
        },
        newPassword: {
        required: "Please Enter New Password",
        },
        confirmPassword: {
        required: "Please Enter Confirm Password",
        equalTo:"Confirm Password Should be same as new password"
        }
        }
});







/*change password validation*/
$('#hangerForm').validate({ 
rules: {
    
    description: {
        required: true,
    }
    ,
    banner: {
    required: true,
    extension: "jpg|png"
    }
},
 messages: 
        {
         description: {
        required: "Please Enter Description",
        }
        }
});




/*change password validation*/
$('#updatehangerForm').validate({ 
rules: {
    
    description: {
        required: true,
    }
   
},
 messages: 
        {
         description: {
        required: "Please Enter Description",
        }
        }
});






/*change password validation*/
$('#map_form').validate({ 
rules: {
    job_name: {
        required: true,
    },
    flyers: {
        required: true,
        number:true
    },
    image: {
   
    extension: "jpg|png"
    }
},
 messages: 
        {
        job_name: {
        required: "Please Enter Job Name",
        },
        flyers: {
        required: "Please Enter Number Of flyers",
        }
        }
});





/*change password validation*/
$('#addSlider').validate({ 
rules: {
    description: {
        required: true,
    },
    banner: {
    required: true,
    extension: "jpg|png"
    }
},
 messages: 
        {
        description: {
        required: "Please Enter Description",
        }
        }
});




/*change password validation*/
$('#updateSlider').validate({ 
rules: {
    description: {
        required: true,
    }
},
 messages: 
        {
        description: {
        required: "Please Enter Description",
        }
        }
});








/*change password validation*/
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
        required: "Please Enter  Password",
        },
        confirm_password: {
        required: "Please Enter Confirm Password",
        equalTo: "Please Enter Same Password Again"
        }
        }
});









