// Selecting all required elements
const toast_wrapper = document.querySelector(".toast_wrapper"),
toast = toast_wrapper.querySelector(".toast"),
title = toast.querySelector("span"),
subTitle = toast.querySelector("p"),
wifiIcon = toast.querySelector(".icon"),
closeIcon = toast.querySelector(".close-icon");

window.onload = ()=>{
    function ajax(){
        let xhr = new XMLHttpRequest(); //creating new XML object
        xhr.open("GET", "https://google.com/", true); //sending get request on this URL
        xhr.onload = ()=>{ //once ajax loaded
            //if ajax status is equal to 200 or less than 300 that mean user is getting data from that provided url
            //or his/her response status is 200 that means he/she is online
            if(xhr.status == 200 && xhr.status < 300){
                toast.classList.remove("offline");
                title.innerText = "You're online now";
                subTitle.innerText = "Hurray! Internet is connected.";
                wifiIcon.innerHTML = '<i class="uil uil-wifi"></i>';
                closeIcon.onclick = ()=>{ //hide toast notification on close icon click
                    toast_wrapper.classList.add("hide");
                }
                setTimeout(()=>{ //hide the toast notification automatically after 5 seconds
                    toast_wrapper.classList.add("hide");
                }, 5000);
            }else{
                offline(); //calling offline function if ajax status is not equal to 200 or not less that 300
            }
        }
        xhr.onerror = ()=>{
            offline(); ////calling offline function if the passed url is not correct or returning 404 or other error
        }
        xhr.send(); //sending get request to the passed url
    }

    function offline(){ //function for offline
        toast_wrapper.classList.remove("hide");
        toast.classList.add("offline");
        title.innerText = "You're offline now";
        subTitle.innerText = "Opps! Internet is disconnected.";
        wifiIcon.innerHTML = '<i class="uil uil-wifi-slash"></i>';
        //console.log("Offline")
    }

    setInterval(()=>{ //this setInterval function call ajax frequently after 100ms
        ajax();
    }, 5000);
}