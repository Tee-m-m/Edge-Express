const glow = document.querySelector(".cursor-glow");

document.addEventListener("mousemove",(e)=>{

glow.style.left=e.clientX+"px";

glow.style.top=e.clientY+"px";

});

const categoryButtons = document.querySelectorAll(".category-btn");

categoryButtons.forEach(button => {

    button.addEventListener("click", () => {

        categoryButtons.forEach(btn =>
            btn.classList.remove("active-category")
        );

        button.classList.add("active-category");

    });

});

const hearts = document.querySelectorAll(".food-top i");

hearts.forEach(heart => {

    heart.addEventListener("click", () => {

        heart.classList.toggle("fa-regular");
        heart.classList.toggle("fa-solid");

        if (heart.classList.contains("fa-solid")) {

            heart.style.color = "#ff4d6d";

        } else {

            heart.style.color = "white";

        }

    });

});

const togglePassword = document.querySelector(".toggle-password");

if(togglePassword){

    togglePassword.addEventListener("click",()=>{

        const password = document.querySelector('input[type="password"]');

        const icon = togglePassword.querySelector("i");

        if(password.type==="password"){

            password.type="text";

            icon.classList.replace("fa-eye","fa-eye-slash");

        }else{

            password.type="password";

            icon.classList.replace("fa-eye-slash","fa-eye");

        }

    });

}