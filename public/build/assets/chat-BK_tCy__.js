document.addEventListener("DOMContentLoaded",function(){var n=document.getElementById("auto-focus-field");n.focus(),setTimeout(function(){n.placeholder=""},1e3),document.getElementById("sendButton").addEventListener("click",function(){const t=document.getElementById("auto-focus-field").value;console.log("Sending to AI:",t),o(t)})});async function o(n){try{const e=await fetch("/chat",{method:"POST",headers:{"Content-Type":"application/x-www-form-urlencoded","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")},body:`userInput=${encodeURIComponent(n)}`});if(!e.ok)throw new Error("Network response was not ok.");const t=await e.json();console.log("Response from AI:",t),document.getElementById("aiResponse").innerText=t.choices[0].message.content}catch(e){console.error("Error:",e)}}