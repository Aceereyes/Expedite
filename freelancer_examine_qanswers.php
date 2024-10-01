<?php
    include('includes/freelancer_header.php');
?>

<div class="page-body">
      <div class="container">
         <div class="row g-2 align-items-center mb-3">
            <div class="col">
               <h2 class="page-title">
                  Pre-recorded Answer
               </h2>
            </div>
            <div class="col-auto ms-auto">
               <div class="btn-list">
                  <span class="d-sm-inline">
                     <a href="<?= base_url("freelancer_examine_qview.php"); ?>" class="btn">
                        <i class="ti ti-arrow-left">
                        </i>
                        Back
                     </a>
                  </span>
               </div>
            </div>
         </div>
      </div>
      <div class="card" style="margin: 0 80px;">
    <!-- Added inline style with margin -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <video id="video" width="100%" height="auto" autoplay></video>
                <div>
                    <button id="startRecording">Start Recording</button>
                    <button id="stopRecording" disabled>Stop Recording</button>
                    <button id="retake" disabled>Retake</button>
                    <button id="play" disabled>Play</button>
                    <button id="pause" disabled>Pause</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group" style="text-align: center; padding-top: 20px">
            <a href="<?= base_url("freelancer_dashboard.php"); ?>">
                <button class="btn btn-primary" id="withdrawBtn" style="width: 200px; border-radius: 20px;">Submit Answer</button>
            </a>
      </div>

<script>

let stream;
let recordedChunks = [];
let recordedBlob;

const video = document.getElementById('video');
const startRecordingBtn = document.getElementById('startRecording');
const stopRecordingBtn = document.getElementById('stopRecording');
const retakeBtn = document.getElementById('retake');
const playBtn = document.getElementById('play');
const pauseBtn = document.getElementById('pause');

startRecordingBtn.addEventListener('click', async () => {
    try {
        stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        video.srcObject = stream;
        startRecordingBtn.disabled = true;
        stopRecordingBtn.disabled = false;
        retakeBtn.disabled = true;
        playBtn.disabled = true;
        pauseBtn.disabled = true;
    } catch (error) {
        console.error('Error accessing media devices:', error);
    }
});

stopRecordingBtn.addEventListener('click', () => {
    if (stream) {
        const tracks = stream.getTracks();
        tracks.forEach(track => track.stop());
    }
    video.srcObject = null;
    startRecordingBtn.disabled = false;
    stopRecordingBtn.disabled = true;
    retakeBtn.disabled = false;
    playBtn.disabled = false;
    pauseBtn.disabled = false;
    const blob = new Blob(recordedChunks, { type: 'video/webm' });
    recordedBlob = URL.createObjectURL(blob);
});

retakeBtn.addEventListener('click', () => {
    recordedChunks = [];
    retakeBtn.disabled = true;
    startRecordingBtn.click();
});

playBtn.addEventListener('click', () => {
    if (recordedBlob) {
        video.src = recordedBlob;
        video.play().catch(error => {
            console.error('Error playing the video:', error);
        });
        playBtn.disabled = true;
        pauseBtn.disabled = false;
    } else {
        console.error('No recorded video available');
    }
});
      </script>

<?php

    include('includes/freelancer_footer.php');
?>