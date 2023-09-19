const express = require("express");
const menu = require("../models/menu");
const router = express.Router();

router.post("", (req,res,next)=>{
    const {name} = req.body;
    menu.findOne({name}).then(userValid=>{
        if(userValid){

            res.status(200).send("<h1>Hello GFG Learner!</h1>");
        }
    });
})
module.exports = router;
