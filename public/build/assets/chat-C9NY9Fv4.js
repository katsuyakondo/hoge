document.addEventListener("DOMContentLoaded",function(){var e=document.getElementById("auto-focus-field");e.focus(),setTimeout(function(){e.placeholder=""},1e3),document.getElementById("sendButton").addEventListener("click",function(){const n=document.getElementById("auto-focus-field").value;console.log("Sending to AI:",n),o(n)})});async function o(e){console.log("sendToAI called with input:",e);try{const t=await fetch("/send-chat",{method:"POST",headers:{"Content-Type":"application/x-www-form-urlencoded","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content")},body:`userInput=${encodeURIComponent(e)}`});if(!t.ok)throw new Error("Network response was not ok.");const n=await t.json();console.log("Response from AI:",n),document.getElementById("aiResponse").innerText=n.choices[0].message.content}catch(t){console.error("Error:",t)}}
