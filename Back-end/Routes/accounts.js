const express = require("express");
const Account = require("../models/account");
const router = express.Router();
router.post("", (req,res,next)=>{
    const {email, password} = req.body;
    Account.findOne({email,password}).then(userValid=>{
        if(userValid){
            res.status(200).json({message: "Login Successfully"});
        }else{
            res.status(401).json({message: "Email or Password is incorrect"});
        }
    });
})
module.exports = router;
