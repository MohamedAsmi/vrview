@extends('agent.layouts.app')

@push('css')
<style>
    .recording-controls {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .recording-controls .btn {
        margin-right: 0;
    }
    
    #recordingStatus {
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 4px;
    }
    
    #recordingStatus.text-danger {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    #recordingStatus.text-success {
        background-color: #d4edda;
        color: #155724;
    }
    
    .voice-record-modal .modal-body {
        padding: 30px;
    }
    
    .voice-record-modal .form-group {
        margin-bottom: 25px;
    }
    
    .voice-record-modal .form-group label {
        font-weight: 600;
        color: #555;
        margin-bottom: 8px;
    }
    
    .float-left .btn {
        margin-right: 10px;
    }
    
    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }
    
    .btn-group-toggle .btn {
        margin-bottom: 10px;
    }
    
    .btn-group-toggle .btn.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }
    
    #textSection, #microphoneSection {
        border: 1px solid #e9ecef;
        border-radius: 5px;
        padding: 15px;
        margin-top: 15px;
    }
    
    #voiceControlsContainer .btn {
        margin-right: 5px;
        margin-bottom: 5px;
    }
    
    #voiceControlsContainer {
        min-height: 40px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }
</style>
@endpush

@section('content')

    <div class="min-height-200px mb-20 pb-20">
        <div class="row mt-2">
            <div class="col-md-5 rooms-container">
                <table class="table table-bordered">
                    <tr>
                        <th style="color: #555766;">Rooms
                            <div class="float-right">
                                <a href="{{ url('/preview?token=fsdfdf') }}" target="_blank"><button
                                        class="btn btn-outline-primary"><i class="fal fa-presentation"
                                            style="padding-right: 4px;"></i>Preview</button></a>
                                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#publish"><i
                                        class="fas fa-circle"
                                        style="@if ($onoffstatus == null or $onoffstatus == 0) color:#e4e3e3; @else color:#61d03e; @endif;"></i>
                                    Publish
                                </button>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            @if (isset($images_order))
                                <div class="row ui-sortable rda" id="room" data-url="{{ route('Image.get',['property' => $property]) }}">
                                    <input type="hidden" name="token" value="{{ $token }}" id="token">
                                    <input type="hidden" name="property_id" value="{{ $property->id }}" id="property_id">
                                    <input type="hidden" name="decrtoken" value="{{ $decrtoken }}" id="decrtoken">
                                    @foreach ($images_order->sortBy('order_id') as $key => $image)
                                        <div class="col-6 m-b-20 ui-sortable-handle mb-4" id="parent" draggable="false">
                                            <div class="rooms-types card-sub <?php if (isset($_GET['sceneid'])) {
                                                if ($_GET['sceneid'] == $image->id) {
                                                    echo 'active';
                                                }
                                            } else {
                                                if ($key == 0) {
                                                    echo 'active';
                                                }
                                            } ?>" id="rooms-types"
                                                data-id='{{ $image->id }}' name='{{ $image->image_title }}'>
                                                <input type="hidden" name="imageOrder[]" value='{{ $image->id }}'>
                                                <div class="rooms-type-close-btn  closeses">
                                                    <i class="fas fa-times closeicon"></i>
                                                </div>
                                                <div class="image-element --- " data-id='{{ $image->id }}'
                                                    style="background-image: url('{{ $image->image && asset('public/' . $image->image) ? asset($image->image) : asset('assets/noimage.png') }}')">
                                                </div>
                                                <div class="rooms-type-footer">
                                                    <form id="namechanged" enctype="multipart/form-data"
                                                        class="is-readonly name-field">
                                                        <div class="imagename" data-name='{{ $image->image_title }}'>
                                                            <a class="load-modal" href="javascript:void(0)" data-url="{{ route('edit.property.name',['id'=> $image->id]) }}" title="Edit">
                                                                <label for="">{{ $image->image_title }}</label>
                                                            </a>
                                                        </div>
                                                        <input type="hidden" id="imageId" name="imagetitleid"
                                                            placeholder="Email" value='{{ $image->id }}' disabled>
                                                      
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            @else
                                <input type="hidden" name="token" value="{{ $token }}" id="token">
                                <input type="hidden" name="property_id" value="{{ $property->id }}" id="property_id">
                                <input type="hidden" name="decrtoken" value="{{ $decrtoken }}" id="decrtoken">
                                <div class="row ui-sortable rda" id="room">
                                </div>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-7">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            @if (isset($images_order))
                                <button class="btn btn-danger" id="start" style="display: none;">
                                    <i class="fas fa-microphone"></i>

                                    Record
                                </button>
                                <button class="btn btn-primary" id="pButton" style="display: none;">
                                    <i class="far fa-play" id="picon"></i>
                                    <div class="music" style="display:none"></div>
                                    Play audio
                                </button>
                                <button class="btn btn-outline-primary" id="pButtondelete" style="display: none;">
                                    <i class="far fa-times" aria-hidden="true"></i>
                                    Delete audio
                                </button>

                                <div class="float-left" id="voiceControlsContainer">
                                    <!-- Record button - shown when no voice recording exists -->
                                    <button class="btn btn-success" id="recordVoiceBtn" onclick="testClick()" data-toggle="modal" data-target="#voiceRecordModal" style="display: none;">
                                        <i class="fas fa-microphone"></i> Record Voice
                                    </button>
                                    
                                    <!-- Play/Pause buttons - shown when voice recording exists -->
                                    <button class="btn btn-primary" id="playVoiceBtn" style="display: none;">
                                        <i class="far fa-play" id="playIcon"></i> Play Voice
                                    </button>
                                    <button class="btn btn-warning" id="pauseVoiceBtn" style="display: none;">
                                        <i class="far fa-pause" id="pauseIcon"></i> Pause Voice
                                    </button>
                                    <button class="btn btn-outline-danger" id="deleteVoiceBtn" style="display: none;">
                                        <i class="far fa-trash"></i> Delete Voice
                                    </button>
                                    
                                    <!-- Loading indicator -->
                                    <button class="btn btn-secondary" id="loadingVoiceBtn" style="display: none;" disabled>
                                        <i class="fas fa-spinner fa-spin"></i> Loading...
                                    </button>
                                </div>
                                <div class="float-right">
                                    <button class="btn btn-outline-primary" id="clearhotspot"><i
                                            class="far fa-times"></i>
                                        Clear all
                                    </button>
                                    <button class="btn btn-primary addhotspot"><i class="far fa-plus"></i> Add hotspot
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                            @else
                                <h5 class="imagehead" style="color:#555766;">No Images Uploaded</h5>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="imagerow">
                            <div class="row hotspotrow">
                                <div class="col-md">
                                    <div class="editor-view">
                                        @if (isset($images_order))
                                            <div id="panorama" style="width: 100%; height: 500px;"></div>
                                        @else
                                            <div id="panorama2">
                                                <img src="{{ asset('assets/noimage.png') }}">
                                            </div>
                                            <div
                                                style="position: absolute;top: 65mm;left: 80mm;font-weight: 600;font-size: 14px;">

                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Voice Recording Modal -->
    <div class="modal fade voice-record-modal" id="voiceRecordModal" tabindex="-1" role="dialog" aria-labelledby="voiceRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="voiceRecordModalLabel">Record Voice for Property</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="voiceRecordForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Choose Recording Method:</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="recordMethod" id="recordMic" value="microphone" checked> 
                                    <i class="fas fa-microphone"></i> Record with Microphone
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="recordMethod" id="recordText" value="text"> 
                                    <i class="far fa-keyboard"></i> Text to Speech
                                </label>
                            </div>
                        </div>

                        <!-- Microphone Recording Section -->
                        <div id="microphoneSection">
                            <div class="form-group">
                                <label>Voice Recording:</label>
                                <div class="recording-controls">
                                    <button type="button" class="btn btn-danger" id="startRecording">
                                        <i class="fas fa-microphone"></i> Start Recording
                                    </button>
                                    <button type="button" class="btn btn-warning" id="stopRecording" style="display: none;">
                                        <i class="far fa-stop"></i> Stop Recording
                                    </button>
                                    <button type="button" class="btn btn-info" id="playRecording" style="display: none;">
                                        <i class="far fa-play"></i> Play
                                    </button>
                                    <span id="recordingStatus" class="ml-3"></span>
                                </div>
                                <div class="mt-3">
                                    <audio id="audioPlayback" controls style="display: none; width: 100%;"></audio>
                                </div>
                            </div>
                        </div>

                        <!-- Text to Speech Section -->
                        <div id="textSection" style="display: none;">
                            <div class="form-group">
                                <label for="textToSpeech">Enter Text to Convert to Speech:</label>
                                <textarea class="form-control" id="textToSpeech" name="text_content" rows="4" placeholder="Type your text here and it will be converted to speech..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Voice Settings:</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="voiceSelect">Voice:</label>
                                        <select class="form-control" id="voiceSelect">
                                            <option value="">Select Voice...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="speechRate">Speed:</label>
                                        <input type="range" class="form-control-range" id="speechRate" min="0.5" max="2" step="0.1" value="1">
                                        <small class="form-text text-muted">Speed: <span id="rateValue">1</span>x</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-success" id="generateSpeech">
                                    <i class="far fa-volume-up"></i> Generate Speech
                                </button>
                                <button type="button" class="btn btn-info" id="playSpeech" style="display: none;">
                                    <i class="far fa-play"></i> Play Generated Speech
                                </button>
                            </div>
                            <div class="mt-3">
                                <audio id="speechPlayback" controls style="display: none; width: 100%;"></audio>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveVoiceRecord" disabled>Save Recording</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('js')
    {{-- <script src="{{ asset('assets/agent/property.js') }}"></script> --}}
    <script>
        // $('#toggle-demo').bootstrapToggle('off');
        var imageUrl = "{{ asset('assets/1/images/477268420.jpg') }}";


        var v;
        var activescene;

        window.addEventListener('load', bodyLoad);
        console.log({!! $default !!});
        console.log({!! $json !!});

        async function bodyLoad() {
            v = pannellum.viewer('panorama', {
                "useWebGL2": true,
                "default": {!! $default !!},
                "scenes": {!! $json !!},
            });

            activescene = v.getScene();
            
            // Check voice recording for initial scene
            setTimeout(() => {
                checkVoiceRecording();
            }, 1000); // Wait a bit for panorama to fully load
        }

        // Anywhere else, check if v is initialized first
        function doSomething() {
            if (v) {
                console.log(v.getScene());
            }
        }
        $(document).on('click', '.rda .rooms-types', async function () {
            $('.rda .rooms-types').removeClass('active');
            await $(this).addClass('active');
            
            // Check for existing voice recording when room is selected
            checkVoiceRecording();
        });

        // Check if current scene has voice recording and update buttons accordingly
        function checkVoiceRecording() {
            let currentSceneId = null;
            try {
                if (v && typeof v.getScene === 'function') {
                    currentSceneId = v.getScene();
                }
            } catch (error) {
                console.error('Error getting scene ID:', error);
            }

            if (!currentSceneId) {
                showRecordButton();
                return;
            }

            // Show loading state
            showLoadingButton();

            // Check if voice recording exists for this scene
            $.ajax({
                url: '{{ route("getaudio.post") }}',
                method: 'POST',
                data: {
                    currentsceneid: currentSceneId,
                    _token: $('input[name="_token"]').val()
                },
                success: function(response) {
                    console.log('Voice check response:', response);
                    console.log('Response type:', typeof response);
                    console.log('Response length:', response ? response.length : 'undefined');
                    
                    if (response && response.length > 0) {
                        // Voice recording exists - show play/pause buttons
                        console.log('Voice record found:', response[0]);
                        console.log('File path:', response[0].file_path);
                        console.log('File name:', response[0].file_name);
                        showPlayPauseButtons(response[0]);
                    } else {
                        // No voice recording - show record button
                        console.log('No voice recording found');
                        showRecordButton();
                    }
                },
                error: function(xhr) {
                    console.error('Error checking voice recording:', xhr);
                    showRecordButton(); // Default to record button on error
                }
            });
        }

        // Show record button only
        function showRecordButton() {
            $('#recordVoiceBtn').show();
            $('#playVoiceBtn, #pauseVoiceBtn, #deleteVoiceBtn, #loadingVoiceBtn').hide();
        }

        // Show play/pause/delete buttons
        function showPlayPauseButtons(voiceRecord) {
            $('#playVoiceBtn, #deleteVoiceBtn').show();
            $('#recordVoiceBtn, #pauseVoiceBtn, #loadingVoiceBtn').hide();
            
            // Store voice record data for playback
            window.currentVoiceRecord = voiceRecord;
            
            // Debug: Log voice record details
            console.log('Setting up play buttons for voice record:', {
                id: voiceRecord.id,
                file_path: voiceRecord.file_path,
                file_name: voiceRecord.file_name,
                record_method: voiceRecord.record_method,
                text_content: voiceRecord.text_content
            });
        }

        // Show loading button
        function showLoadingButton() {
            $('#loadingVoiceBtn').show();
            $('#recordVoiceBtn, #playVoiceBtn, #pauseVoiceBtn, #deleteVoiceBtn').hide();
        }

        // Audio player functionality
        let currentAudio = null;

        // Play voice recording
        $('#playVoiceBtn').click(function() {
            if (!window.currentVoiceRecord) {
                alert('No voice recording found');
                return;
            }

            try {
                // Stop any currently playing audio
                if (currentAudio) {
                    currentAudio.pause();
                    currentAudio = null;
                }

                // Use the secure route to access audio file
                const audioPath = '{{ route("voice.record.play", ":id") }}'.replace(':id', window.currentVoiceRecord.id);
                console.log('Audio path:', audioPath);
                
                currentAudio = new Audio(audioPath);
                
                // Add error event listener before other events
                currentAudio.onerror = function(e) {
                    console.error('Audio error:', e);
                    console.error('Audio error details:', {
                        error: currentAudio.error,
                        networkState: currentAudio.networkState,
                        readyState: currentAudio.readyState,
                        src: currentAudio.src
                    });
                    
                    let errorMessage = 'Could not load audio file';
                    if (currentAudio.error) {
                        switch(currentAudio.error.code) {
                            case 1: // MEDIA_ERR_ABORTED
                                errorMessage = 'Audio loading was aborted';
                                break;
                            case 2: // MEDIA_ERR_NETWORK
                                errorMessage = 'Network error while loading audio';
                                break;
                            case 3: // MEDIA_ERR_DECODE
                                errorMessage = 'Audio format not supported or file corrupted';
                                break;
                            case 4: // MEDIA_ERR_SRC_NOT_SUPPORTED
                                errorMessage = 'Audio format not supported by browser';
                                break;
                        }
                    }
                    
                    // Try alternative path with cache busting
                    console.log('Trying alternative storage path...');
                    const alternativePath = '{{ asset("storage") }}/' + window.currentVoiceRecord.file_path + '?t=' + Date.now();
                    console.log('Alternative path:', alternativePath);
                    
                    currentAudio = new Audio(alternativePath);
                    
                    currentAudio.onerror = function() {
                        alert('Error: ' + errorMessage + '\n\nFile may be corrupted or in an unsupported format. Please try recording again.');
                        $('#pauseVoiceBtn').hide();
                        $('#playVoiceBtn').show();
                        console.error('Both audio paths failed:', {
                            primary: audioPath,
                            alternative: alternativePath,
                            errorMessage: errorMessage
                        });
                    };
                    
                    // Set up events for alternative audio
                    setupAudioEvents();
                    currentAudio.play();
                };
                
                // Setup audio events
                setupAudioEvents();
                
                // Start playing
                currentAudio.play().catch(function(error) {
                    console.error('Play failed:', error);
                    alert('Failed to play audio: ' + error.message);
                });

            } catch (error) {
                console.error('Error playing audio:', error);
                alert('Error playing audio file: ' + error.message);
            }
        });

        // Setup audio event listeners
        function setupAudioEvents() {
            if (!currentAudio) return;
            
            // Update button states when audio starts playing
            currentAudio.onplay = function() {
                $('#playVoiceBtn').hide();
                $('#pauseVoiceBtn').show();
                $('#playIcon').removeClass('fa-play').addClass('fa-pause');
                console.log('Audio started playing');
            };

            // Update button states when audio ends
            currentAudio.onended = function() {
                $('#pauseVoiceBtn').hide();
                $('#playVoiceBtn').show();
                $('#playIcon').removeClass('fa-pause').addClass('fa-play');
                console.log('Audio playback ended');
            };

            // Handle audio loading
            currentAudio.onloadstart = function() {
                console.log('Audio loading started');
            };

            currentAudio.oncanplay = function() {
                console.log('Audio can start playing');
            };
        }

        // Pause voice recording
        $('#pauseVoiceBtn').click(function() {
            if (currentAudio) {
                currentAudio.pause();
                $('#pauseVoiceBtn').hide();
                $('#playVoiceBtn').show();
                $('#playIcon').removeClass('fa-pause').addClass('fa-play');
            }
        });

        // Delete voice recording
        $('#deleteVoiceBtn').click(function() {
            if (!window.currentVoiceRecord) {
                alert('No voice recording found');
                return;
            }

            if (confirm('Are you sure you want to delete this voice recording?')) {
                deleteVoiceRecording();
            }
        });

        // Delete voice recording function
        function deleteVoiceRecording() {
            const voiceRecordId = window.currentVoiceRecord.id;
            
            $.ajax({
                url: '{{ route("voice.record.delete") }}',
                method: 'DELETE',
                data: {
                    id: voiceRecordId,
                    _token: $('input[name="_token"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        alert('Voice recording deleted successfully');
                        
                        // Stop any playing audio
                        if (currentAudio) {
                            currentAudio.pause();
                            currentAudio = null;
                        }
                        
                        // Update UI to show record button
                        showRecordButton();
                        
                        // Remove audio icon from room thumbnail
                        const currentRoom = $('.rda .rooms-types.active');
                        if (currentRoom.length) {
                            currentRoom.find('#musicicon').remove();
                        }
                        
                        // Clear stored voice record
                        window.currentVoiceRecord = null;
                    } else {
                        alert('Failed to delete voice recording');
                    }
                },
                error: function(xhr) {
                    console.error('Error deleting voice recording:', xhr);
                    alert('Failed to delete voice recording');
                }
            });
        }

        // Voice Recording Functionality
        let mediaRecorder;
        let audioChunks = [];
        let recordedBlob;
        let speechSynthesis = window.speechSynthesis;
        let voices = [];
        let generatedSpeechBlob;

        // Load available voices for text-to-speech
        function loadVoices() {
            voices = speechSynthesis.getVoices();
            const voiceSelect = $('#voiceSelect');
            voiceSelect.html('<option value="">Default Voice</option>');
            
            voices.forEach((voice, index) => {
                voiceSelect.append(`<option value="${index}">${voice.name} (${voice.lang})</option>`);
            });
        }

        // Load voices when they're available
        if (speechSynthesis.onvoiceschanged !== undefined) {
            speechSynthesis.onvoiceschanged = loadVoices;
        }
        loadVoices();

        // Switch between recording methods
        $('input[name="recordMethod"]').change(function() {
            if ($(this).val() === 'microphone') {
                $('#microphoneSection').show();
                $('#textSection').hide();
            } else {
                $('#microphoneSection').hide();
                $('#textSection').show();
            }
        });

        // Update speech rate display
        $('#speechRate').on('input', function() {
            $('#rateValue').text($(this).val());
        });

        // Generate speech from text
        $('#generateSpeech').click(function() {
            const text = $('#textToSpeech').val().trim();
            if (!text) {
                alert('Please enter text to convert to speech');
                return;
            }

            // Disable button during generation
            $('#generateSpeech').prop('disabled', true).text('Generating...');

            try {
                // Method 1: Try advanced audio recording
                generateSpeechWithRecording(text);
            } catch (error) {
                console.log('Advanced method failed, trying simple method:', error);
                // Method 2: Fallback to simple speech synthesis
                generateSpeechSimple(text);
            }
        });

        function generateSpeechWithRecording(text) {
            // Create audio context for recording
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const chunks = [];
            let mediaRecorder;

            // Create a media stream destination
            const destination = audioContext.createMediaStreamDestination();
            
            // Use Web Audio API to capture speech synthesis
            const utterance = new SpeechSynthesisUtterance(text);
            const selectedVoiceIndex = $('#voiceSelect').val();
            
            if (selectedVoiceIndex && voices[selectedVoiceIndex]) {
                utterance.voice = voices[selectedVoiceIndex];
            }
            
            utterance.rate = parseFloat($('#speechRate').val());
            
            // Create MediaRecorder to capture the audio
            mediaRecorder = new MediaRecorder(destination.stream, {
                mimeType: 'audio/webm;codecs=opus'
            });

            mediaRecorder.ondataavailable = function(event) {
                if (event.data.size > 0) {
                    chunks.push(event.data);
                }
            };

            mediaRecorder.onstop = function() {
                // Convert webm to wav-compatible blob
                const audioBlob = new Blob(chunks, { type: 'audio/wav' });
                
                // Create a proper File object with correct type
                generatedSpeechBlob = new File([audioBlob], 'generated_speech.wav', {
                    type: 'audio/wav',
                    lastModified: Date.now()
                });
                
                const audioUrl = URL.createObjectURL(generatedSpeechBlob);
                $('#speechPlayback').attr('src', audioUrl).show();
                $('#playSpeech').show();
                $('#saveVoiceRecord').prop('disabled', false);
                $('#generateSpeech').prop('disabled', false).text('Generate Speech');
                
                console.log('Generated speech file:', generatedSpeechBlob);
            };

            // Start recording before speaking
            mediaRecorder.start();
            
            utterance.onstart = function() {
                console.log('Speech synthesis started');
            };

            utterance.onend = function() {
                console.log('Speech synthesis ended');
                // Stop recording after a short delay to ensure all audio is captured
                setTimeout(() => {
                    if (mediaRecorder.state === 'recording') {
                        mediaRecorder.stop();
                    }
                }, 500);
            };

            utterance.onerror = function(event) {
                console.error('Speech synthesis error:', event);
                $('#generateSpeech').prop('disabled', false).text('Generate Speech');
                // Try fallback method
                generateSpeechSimple(text);
            };

            // Start speech synthesis
            speechSynthesis.speak(utterance);
        }

        function generateSpeechSimple(text) {
            // Simple method: Just create a text file and let backend handle TTS
            const textBlob = new Blob([text], { type: 'text/plain' });
            generatedSpeechBlob = new File([textBlob], 'text_to_speech.txt', {
                type: 'text/plain',
                lastModified: Date.now()
            });
            
            // Show placeholder audio (we'll let the backend generate the actual audio)
            $('#speechPlayback').hide();
            $('#playSpeech').hide();
            $('#saveVoiceRecord').prop('disabled', false);
            $('#generateSpeech').prop('disabled', false).text('Generate Speech');
            
            alert('Text prepared for speech synthesis. Click Save to process.');
            console.log('Using simple text method');
        }

        // Play generated speech
        $('#playSpeech').click(function() {
            $('#speechPlayback')[0].play();
        });

        // Start Recording
        $('#startRecording').click(async function() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                
                // Check supported formats
                let mimeType = 'audio/webm';
                if (MediaRecorder.isTypeSupported('audio/webm;codecs=opus')) {
                    mimeType = 'audio/webm;codecs=opus';
                } else if (MediaRecorder.isTypeSupported('audio/mp4')) {
                    mimeType = 'audio/mp4';
                } else if (MediaRecorder.isTypeSupported('audio/wav')) {
                    mimeType = 'audio/wav';
                }
                
                console.log('Using MIME type:', mimeType);
                
                mediaRecorder = new MediaRecorder(stream, { mimeType: mimeType });
                audioChunks = [];

                mediaRecorder.ondataavailable = event => {
                    if (event.data.size > 0) {
                        audioChunks.push(event.data);
                        console.log('Audio chunk received:', event.data.size, 'bytes');
                    }
                };

                mediaRecorder.onstop = () => {
                    console.log('Total audio chunks:', audioChunks.length);
                    console.log('Total size:', audioChunks.reduce((total, chunk) => total + chunk.size, 0), 'bytes');
                    
                    recordedBlob = new Blob(audioChunks, { type: mimeType });
                    console.log('Created blob:', recordedBlob.size, 'bytes, type:', recordedBlob.type);
                    
                    const audioUrl = URL.createObjectURL(recordedBlob);
                    $('#audioPlayback').attr('src', audioUrl).show();
                    $('#playRecording').show();
                    $('#saveVoiceRecord').prop('disabled', false);
                };

                mediaRecorder.onerror = (event) => {
                    console.error('MediaRecorder error:', event.error);
                    alert('Recording error: ' + event.error);
                };

                mediaRecorder.start(1000); // Collect data every second
                console.log('Recording started with format:', mimeType);
                
                $('#startRecording').hide();
                $('#stopRecording').show();
                $('#recordingStatus').text('Recording...').addClass('text-danger');
                
            } catch (error) {
                console.error('Error accessing microphone:', error);
                alert('Could not access microphone. Please check permissions.');
            }
        });

        // Stop Recording
        $('#stopRecording').click(function() {
            if (mediaRecorder && mediaRecorder.state === 'recording') {
                mediaRecorder.stop();
                mediaRecorder.stream.getTracks().forEach(track => track.stop());
            }
            
            $('#startRecording').show();
            $('#stopRecording').hide();
            $('#recordingStatus').text('Recording completed').removeClass('text-danger').addClass('text-success');
        });

        // Play Recording
        $('#playRecording').click(function() {
            $('#audioPlayback')[0].play();
        });

        // Save Voice Record
        $('#saveVoiceRecord').click(function() {
            // Get current scene ID from panorama viewer
            let currentSceneId = null;
            try {
                if (v && typeof v.getScene === 'function') {
                    currentSceneId = v.getScene();
                    console.log('Current scene ID:', currentSceneId);
                } else {
                    console.log('Panorama viewer not available');
                }
            } catch (error) {
                console.error('Error getting scene ID:', error);
            }

            if (!currentSceneId) {
                alert('Please select a room/scene first');
                return;
            }

            // Determine which blob to use based on recording method
            let audioBlob = null;
            const recordMethod = $('input[name="recordMethod"]:checked').val();
            
            if (recordMethod === 'microphone') {
                if (!recordedBlob) {
                    alert('Please record audio first');
                    return;
                }
                // Create proper File object for microphone recording
                const extension = recordedBlob.type.includes('webm') ? 'webm' : 
                                 recordedBlob.type.includes('mp4') ? 'mp4' : 'wav';
                const fileName = 'microphone_recording.' + extension;
                
                audioBlob = new File([recordedBlob], fileName, {
                    type: recordedBlob.type,
                    lastModified: Date.now()
                });
                
                console.log('Created file for upload:', {
                    name: fileName,
                    type: recordedBlob.type,
                    size: audioBlob.size
                });
            } else {
                if (!generatedSpeechBlob) {
                    alert('Please generate speech first');
                    return;
                }
                audioBlob = generatedSpeechBlob; // Already a File object
            }

            console.log('Audio blob to upload:', audioBlob);
            console.log('File type:', audioBlob.type);
            console.log('File size:', audioBlob.size);
            console.log('File name:', audioBlob.name);

            const formData = new FormData();
            formData.append('property_images_id', currentSceneId);
            formData.append('record_method', recordMethod);
            formData.append('voice_file', audioBlob);
            
            // Add text content if using text-to-speech
            if (recordMethod === 'text') {
                formData.append('text_content', $('#textToSpeech').val());
            }
            
            formData.append('_token', $('input[name="_token"]').val());

            // Debug FormData
            for (let [key, value] of formData.entries()) {
                console.log('FormData:', key, value);
            }

            // Disable button during save
            $('#saveVoiceRecord').prop('disabled', true).text('Saving...');

            $.ajax({
                url: '{{ route("voice.record.store") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response.success) {
                        alert('Voice recording saved successfully!');
                        // Hide modal using jQuery
                        $('#voiceRecordModal').modal('hide');
                        resetRecordingForm();
                        
                        // Show audio icon on the current scene
                        const currentRoom = $('.rda .rooms-types.active');
                        if (currentRoom.length) {
                            currentRoom.find('.float-right').html('<span id="musicicon" class="far fa-volume"></span>');
                        }
                        
                        // Refresh voice controls to show play/pause buttons
                        checkVoiceRecording();
                    } else {
                        alert('Failed to save recording. Please try again.');
                    }
                },
                error: function(xhr) {
                    console.error('Error saving recording:', xhr);
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        alert('Error: ' + xhr.responseJSON.message);
                    } else {
                        alert('Failed to save recording. Please try again.');
                    }
                },
                complete: function() {
                    // Re-enable button
                    $('#saveVoiceRecord').prop('disabled', false).text('Save Recording');
                }
            });
        });

        function resetRecordingForm() {
            $('#voiceRecordForm')[0].reset();
            
            // Reset microphone recording
            $('#audioPlayback').hide();
            $('#playRecording').hide();
            $('#startRecording').show();
            $('#stopRecording').hide();
            $('#recordingStatus').text('').removeClass('text-danger text-success');
            
            // Reset text-to-speech
            $('#speechPlayback').hide();
            $('#playSpeech').hide();
            $('#textToSpeech').val('');
            $('#rateValue').text('1');
            $('#speechRate').val(1);
            
            // Reset form state
            $('#saveVoiceRecord').prop('disabled', true).text('Save Recording');
            $('#microphoneSection').show();
            $('#textSection').hide();
            $('input[name="recordMethod"][value="microphone"]').prop('checked', true);
            $('label:has(input[name="recordMethod"][value="microphone"])').addClass('active');
            $('label:has(input[name="recordMethod"][value="text"])').removeClass('active');
            
            // Clear blobs
            audioChunks = [];
            recordedBlob = null;
            generatedSpeechBlob = null;
        }
    </script>
    
@endpush
<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script>
    // Simplified script - just test modal opening
    function testClick() {
        console.log('Button clicked');
        
        // Check if a scene is selected
        if (!v || typeof v.getScene !== 'function' || !v.getScene()) {
            alert('Please select a room/scene first');
            return;
        }
        
        // Try to open modal manually
        $('#voiceRecordModal').modal('show');
    }
    
    $(document).ready(function() {
        console.log('Page loaded');
        
        // Test if modal exists
        if ($('#voiceRecordModal').length) {
            console.log('Modal found in DOM');
        } else {
            console.log('Modal NOT found in DOM');
        }
    });
    
    window.appRoutes = {
        imageGet: "{{ route('Image.get', ['property' => $property]) }}",
        imageupload: "{{ route('property.update', ['property' => $property->id]) }}",
        getImage: "{{ route('getimage', ['property' => $property]) }}",
        droproute: "{{ route('dropzone.upload') }}",
        getaudioroute: "{{ route('getaudio.post') }}",
        inserthotsportroute: "{{ route('hotspot.insert') }}",
        deletehotsportroute: "{{ route('hotspot.delete') }}",
    };
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('assets/js/libpannellum.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/pannellum.js')}}"></script>
<script src="{{ asset('assets/js/imagesevent.js') }}"></script>
<script src="{{asset('assets/js/hotspot.js')}}"></script>
<script src="{{asset('assets/js/sortable.js')}}"></script>
<script src="{{ asset('assets/js/getallimage.js') }}"></script>
<script src="{{asset('assets/js/record.js')}}"></script>

