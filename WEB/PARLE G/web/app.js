 require('dotenv').config();
const express = require("express");
const ejs = require("ejs");
const bodyParser = require("body-parser");
const mongoose = require("mongoose");
const session = require("express-session");
const passport = require("passport");
const passportLocalMongoose = require("passport-local-mongoose");
const cookieParser = require("cookie-parser");

const app = express();

app.use(express.static("public"));
app.set("view engine", "ejs");
app.use(bodyParser.urlencoded({
    extended: true
}));

app.use(session ({
    secret: process.env.SECRET,
    resave: false,
    saveUninitialized: false
}));
app.use(cookieParser());

app.use(passport.initialize());
app.use(passport.session());

mongoose.connect("mongodb://95.216.141.221:27017/userDB", {useNewUrlParser: true});

const userSchema = new mongoose.Schema( {
    email: String,
    password: String,
});

userSchema.plugin(passportLocalMongoose);

const User = new mongoose.model("User", userSchema);

passport.use(User.createStrategy());

passport.serializeUser(User.serializeUser());
passport.deserializeUser(User.deserializeUser());

app.get("/", function(req, res) {
    res.render("login");
});

app.get("/secrets", function(req, res) {
    if(req.isAuthenticated()) {
        res.render("secrets");
    }else {
        res.redirect("/");
    }
});

app.get("/logout", function(req, res) {
    req.logout(function(err) {
        if(err) {
            console.log(err);
        }else {
            res.clearCookie("JWT");
            res.redirect("/");
            // res.end();
        }
    }); 
});

app.post("/login", function(req, res) {
        
    //Register user
    User.register({username:req.body.username}, req.body.password, function(err, user) {
        if(err) {
            console.log(err);
            res.redirect("/");
        } else {
            passport.authenticate("local") (req, res, function() {
                res.redirect("/secrets");
            });
        }
    });

});







app.listen(3000, function() {
    console.log("Server started at Port 3000.");
});
