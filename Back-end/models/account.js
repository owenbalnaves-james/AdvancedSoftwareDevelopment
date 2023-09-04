const mongoose = require("mongoose");

const accountSchema = mongoose.Schema({
    email: {type:String},
	password:{type: String}
})

module.exports = mongoose.model("Account", accountSchema);