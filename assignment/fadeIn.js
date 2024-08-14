window.addEventListener("scroll", fadeIn);

        function fadeIn(){
            var fadeIn = document.querySelectorAll(".fadeIn");

            for(var i = 0; i<fadeIn.length; i++){
                var windowheight = window.innerHeight;
                var fadeInTop = fadeIn[i].getBoundingClientRect().top;
                var fadeInPoint = 150;

                if(fadeInTop < windowheight - fadeInPoint){
                    fadeIn[i].classList.add("active");
                }
                else{
                    fadeIn[i].classList.remove("active");
                }
            }
        }