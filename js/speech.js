// spraak interactie
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

const message = document.getElementById("message");
const textWaiting = document.getElementById("waiting");
const image1 = document.getElementById("image1");
const downloads = document.getElementById("downloads_link");

startRecognition = () => {
    if (SpeechRecognition !== undefined) { // test if speechrecognitio is supported
        let recognition = new SpeechRecognition();
        recognition.lang = 'nl-NL'; // which language is used?
        recognition.interimResults = false; // https://developer.mozilla.org/en-US/docs/Web/API/SpeechRecognition/interimResults
        recognition.continuous = false; // https://developer.mozilla.org/en-US/docs/Web/API/SpeechRecognition/continuous

        recognition.onstart = () => {
            message.innerHTML = `Ik luister, praat in de microfoon alsjeblieft<br>Zeg"help me" voor help`;
            console.log("luisteren");
            textWaiting.classList.add("hide"); // hide the output
        };

        recognition.onspeechend = () => {
            message.innerHTML = `Ik ben gestop met luisteren `;
            console.log("stop luisteren");
            recognition.stop();
        };

        recognition.onresult = (result) => {
            let transcript = result.results[0][0].transcript;
            let confidenceTranscript = Math.floor(result.results[0][0].confidence * 100); // calc. 'confidence'
            //output.classList.remove("hide"); // show the output
            //   output.innerHTML = `Ik ben ${confidenceTranscript}% zeker dat je dit zei: <b>${transcript}</b>`;
            actionSpeech(transcript);
        };

        recognition.start();
    }
    else {  // speechrecognition is not supported
        message.innerHTML = "sorry speech to text support deze browser niet";
    }
};

// process speech results
actionSpeech = (speechText) => {
    speechText = speechText.toLowerCase().trim(); // trim spaces + to lower case
    console.log(speechText); // debug 
    switch (speechText) {
        // switch evaluates using stric comparison, ===
        case "download":
            downloads.classList.remove("hide");
            break;
        case "reset":

            break;
        case "windows":
            document.body.style.display = "block";
            break;
        case "android": // let op, "fall-through"
            document.body.style.display = "block";
            break;
        case "help me":
            alert("Zeg welke browser download je nodig hebt. De opties zijn, ios, windows en android");
            break;
        default:
        // do nothing yet
    }
}