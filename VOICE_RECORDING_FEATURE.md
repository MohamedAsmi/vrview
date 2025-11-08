# Voice Recording Feature

## Overview
This feature allows agents to add voice messages to specific room scenes in their property tours. The system supports both microphone recording and text-to-speech conversion.

## Features

### 1. **Dual Recording Methods**
- **Microphone Recording**: Direct audio recording from user's microphone
- **Text-to-Speech**: Convert written text into speech using browser's speech synthesis

### 2. **Automatic Scene Detection**
- Automatically detects the currently viewed room/scene
- Associates voice recordings with specific panoramic images
- No manual property or scene selection required

## How to Use

### Step 1: Navigate to Scene
1. Go to the property images management page
2. Select the room/scene you want to add voice to by clicking on it
3. The panoramic view will display the selected scene

### Step 2: Record Voice
1. Click the green "Record Voice" button
2. Choose your recording method:
   - **Microphone**: Record your voice directly
   - **Text to Speech**: Type text to be converted to voice

#### For Microphone Recording:
1. Click "Start Recording"
2. Speak your message
3. Click "Stop Recording"
4. Use "Play" to preview
5. Click "Save Recording"

#### For Text-to-Speech:
1. Type your text in the text area
2. Select voice and adjust speed (optional)
3. Click "Generate Speech"
4. Use "Play Generated Speech" to preview
5. Click "Save Recording"

### Step 3: Confirmation
- A music icon will appear on the room thumbnail indicating audio is available
- The voice recording is automatically associated with the current scene

## Technical Features

### Database Structure
```sql
voice_records:
- id (primary key)
- property_images_id (links to specific room image)
- user_id (creator)
- record_method ('microphone' or 'text')
- text_content (for text-to-speech records)
- file_path (audio file location)
- file_name (original filename)
- timestamps
```

### Text-to-Speech Options
- **Multiple Voices**: Browser's available voices
- **Speed Control**: Adjustable playback speed (0.5x - 2x)
- **Language Support**: Based on browser's speech synthesis capabilities

### File Management
- Audio files stored in `storage/app/public/voice_records/`
- Supports WAV, MP3, OGG formats
- Maximum file size: 10MB
- Automatic filename generation

### Security
- Users can only add recordings to their own properties
- Scene validation ensures recording goes to correct room
- File type and size validation

## Browser Compatibility

### Microphone Recording
- Chrome 47+
- Firefox 25+
- Safari 14+
- Edge 79+

### Text-to-Speech
- Chrome 33+
- Firefox 49+
- Safari 7+
- Edge 14+

## API Endpoints
- `POST /agent/voice/record` - Store voice recording with scene association

## Error Handling
- **No Scene Selected**: Prompts user to select a room first
- **Microphone Issues**: Permission handling and fallback messages
- **Text-to-Speech**: Voice loading and synthesis error handling
- **File Upload**: Size and format validation with user feedback

## Usage Tips
1. **Select Scene First**: Always click on a room thumbnail before recording
2. **Text Length**: Keep text reasonable for speech synthesis (under 1000 characters)
3. **Microphone**: Ensure microphone permissions are granted
4. **Preview**: Always preview recordings before saving
5. **Multiple Takes**: Recordings can be overwritten for the same scene

This feature enhances property tours by adding personalized voice guidance for each room, making virtual property viewing more engaging and informative.