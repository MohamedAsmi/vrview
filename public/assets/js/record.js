 var base_url = window.location.origin;
   function timeToString(time) {
        let diffInHrs = time / 3600000;
        let hh = Math.floor(diffInHrs);

        let diffInMin = (diffInHrs - hh) * 60;
        let mm = Math.floor(diffInMin);

        let diffInSec = (diffInMin - mm) * 60;
        let ss = Math.floor(diffInSec);

        let diffInMs = (diffInSec - ss) * 100;
        let ms = Math.floor(diffInMs);

        let formattedMM = mm.toString().padStart(2, "0");
        let formattedSS = ss.toString().padStart(2, "0");
        let formattedMS = ms.toString().padStart(2, "0");

        return `${formattedMM}:${formattedSS}`;
    }


    let startTime;
    let elapsedTime = 0;
    let timerInterval;


    function print(txt) {
        document.getElementById("display").innerHTML = txt;
    }



    function start() {
        startTime = Date.now() - elapsedTime;
        timerInterval = setInterval(function printTime() {
            elapsedTime = Date.now() - startTime;
            print(timeToString(elapsedTime));
        }, 10);
    }

    function pause() {
        clearInterval(timerInterval);
    }

    function reset() {
        clearInterval(timerInterval);
        print("00:00");
        elapsedTime = 0;

    }


    let playButton = document.getElementById("playButton");
    let pauseButton = document.getElementById("pauseButton");
    // let resetButton = document.getElementById("resetButton");
    let clipName = null;
    let record = document.getElementById('start');
    let stop = document.getElementById('stop');
    let pauseaudio = document.getElementById('pauseaudio');
    let resumeaudio = document.getElementById('resumeaudio');
    let soundClips = document.querySelector('.sound-clip');
    let deleteButton = document.querySelector('.delete');
    
    if (navigator.mediaDevices) {
        $('#record').on('hidden.bs.modal', function () {
            $('#start').show();
        });
        $('#cancelaudio').on('click', function () {
            var currentsceneid = v.getScene();
            var access_token =$('#token').val();
            window.location = "vrview?token="+access_token+"&sceneid="+currentsceneid;
        });
        

        var constraints = {
            audio: true
        };
        var chunks = [];

        navigator.mediaDevices.getUserMedia({
                audio: true
            })
            .then(function(stream) {

                var mediaRecorder = new MediaRecorder(stream);

                record.onclick = function() {
                    $('#start').hide();
                    $("#resumeaudio").hide();
                    if($('#record').modal('show')){
                        
                        start();
                        if (mediaRecorder.state === 'recording') {
                            return;
                        }

                        console.log(mediaRecorder.state);
                        console.log("recorder started");

                        mediaRecorder.start();

                        record.style.background = "red";
                        record.style.color = "black";
                    }else{
                        mediaRecorder.stop();
                    }
                    
                    
                }
                pauseaudio.onclick = function() {
                    $(this).hide();
                    pause();
                    $("#resumeaudio").show();
                     mediaRecorder.pause();
                     console.log(mediaRecorder.state);
                }
                resumeaudio.onclick = function() {
                    $(this).hide();
                    start();
                    $("#pauseaudio").show();
                     mediaRecorder.resume();
                     console.log(mediaRecorder.state);
                }
                stop.onclick = function() {
                    $('#start').show();
                    $('#pauseaudio').hide();
                    pause();
                    // $('#time').append($('.time').text());
                    if (mediaRecorder.state === 'inactive') {
                        return;
                    }
                    console.log(mediaRecorder.state);
                    console.log("recorder stopped");

                    mediaRecorder.stop();
                    record.style.background = "";
                    record.style.color = "";
                }

                mediaRecorder.onstop = function(e) {
                    console.log("data available after MediaRecorder.stop() called.");

                    var clipContainer = document.createElement('article');
                    var clipLabel = document.createElement('p');
                    var audio = document.createElement('audio');
                    var deleteButton = document.createElement('button');

                    clipContainer.classList.add('clip');
                    audio.setAttribute('controls', '');
                    deleteButton.innerHTML = "Delete";
                    deleteButton.className = "delete";

                    clipLabel.innerHTML = clipName;

                    // clipContainer.appendChild(audio);
                    // clipContainer.appendChild(clipLabel);
                    // clipContainer.appendChild(deleteButton);
                    // soundClips.innerHTML = '';
                    // soundClips.appendChild(clipContainer);

                    audio.controls = true;
                    var blob = new Blob(chunks, {
                        'type': 'audio/ogg; codecs=opus'
                    });
                    chunks = [];
                    var audioURL = URL.createObjectURL(blob);
                    audio.src = audioURL;
                    console.log("recorder stopped");

                    var mp3file = audioURL;
                    deleteButton.onclick = function(e) {
                        evtTgt = e.target;
                        evtTgt.parentNode.parentNode.removeChild(evtTgt.parentNode);
                    }
                }
                let order = 0;
                mediaRecorder.ondataavailable = async function(e) {
                    chunks.push(e.data);

                    if (e.data && e.data.size > 0) {
                        var reader = new FileReader();
                        reader.readAsArrayBuffer(e.data);
                        reader.onloadend = async function(event) {
                            let arrayBuffer = reader.result;
                            let uint8View = new Uint8Array(arrayBuffer);
                            console.log(mediaRecorder);
                            
                            saveaudio(uint8View,order,clipName);
                            
                                
                            
                            
                            order += 1;
                        }

                    }
                }
                
            })
            
            .catch(function(err) {
		if($('.imagehead').text() != "No Images Uploaded"){
                    $('.alert-w').append('<div class="alert alert-warning" role="alert">It Seems Like Your Microphone Is Disabled In Browser, You Would Need To Enable It First To Use Voice Option Or Record Feature..<i class="fas fa-exclamation-circle text-right" style="float:right;margin-top: 3px;font-size: 20px;"></i></div>');

               }
                
		console.log('The following error occurred: ' + err);
            })
            
            
    }



$(document).on('click','#saveaudioa',function(){
    $("#record").hide();
    stop.onclick();            
    $('#time').hide();
    
});

            

    function saveaudio(uint8View,order,clipName){
        var currentsceneid = v.getScene();
        var access_token =$('#token').val();
        var propid =$('#propid').val();

        $.ajax({
            type: "post",
            url:  "saveaudio",
            dataType: 'json',
            data: JSON.stringify({
                chunk: uint8View,
                order: order,
                fileName: clipName,
                currentsceneid:currentsceneid,
                propid:propid
            }),

            beforeSend: function(){
                $("#loadMe").modal({
                    show: true 
                });   
            },
            success: function(response) {
                window.location = "vrview?token="+access_token+"&sceneid="+currentsceneid;

            }
        });
    }