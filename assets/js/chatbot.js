document.addEventListener("DOMContentLoaded", function () {
    console.log("Chatbot cargado correctamente.");

    const chatbotToggle = document.getElementById("chatbot-toggle");
    const chatbotWindow = document.getElementById("chatbot-window");
    const chatbotClose = document.getElementById("chatbot-close");
    const chatbotMessages = document.getElementById("chatbot-messages");
    const chatbotInput = document.getElementById("chatbot-input");
    const chatbotSend = document.getElementById("chatbot-send");
    const chatbotSuggestions = document.getElementById("chatbot-suggestions");

    if (!chatbotToggle || !chatbotWindow || !chatbotClose || !chatbotMessages || !chatbotInput || !chatbotSend || !chatbotSuggestions) {
        console.error("Error: Uno o más elementos del chatbot no se encontraron.");
        return;
    }

    // Mostrar/ocultar chatbot
    chatbotToggle.addEventListener("click", function () {
        chatbotWindow.classList.toggle("hidden");
    });

    chatbotClose.addEventListener("click", function () {
        chatbotWindow.classList.add("hidden");
    });

    chatbotSend.addEventListener("click", function () {
        const userMessage = chatbotInput.value.trim();
        if (userMessage !== "") {
            appendMessage("Tú", userMessage);
            chatbotInput.value = "";
            setTimeout(() => respondToUser(userMessage), 500);
        }
    });

    // Función para agregar mensajes al chat
    function appendMessage(sender, text) {
        const messageElement = document.createElement("div");
        messageElement.classList.add("chatbot-message");
        messageElement.innerHTML = `<strong>${sender}:</strong> ${text}`;
        chatbotMessages.appendChild(messageElement);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    // Respuestas predefinidas
    function respondToUser(userMessage) {
        let response;

        const lowerMessage = userMessage.toLowerCase();

        if (lowerMessage.includes("crear cotización")) {
            response = "Para crear una cotización, accede a 'Crear Cotización' en el menú.";
        } else if (lowerMessage.includes("contactar soporte")) {
            response = "Puedes contactar al soporte en la sección 'Contáctanos'.";
        } else if (lowerMessage.includes("ver mis quejas")) {
            response = "Puedes ver tus quejas en el 'Buzón de Quejas'.";
        } else if (lowerMessage.includes("cerrar sesión")) {
            response = "Para cerrar sesión, haz clic en 'Cerrar Sesión' en el menú.";
        } else if (lowerMessage.includes("mapa")) {
            response = "Para ver la ubicación de la empresa, accede a la sección 'Mapa'.";
        } else {
            response = "Lo siento, no entiendo la pregunta. ¿Puedes reformularla?";
        }

        appendMessage("Bot", response);
    }

    // Agregar preguntas sugeridas
    function addSuggestedQuestions() {
        const questions = [
            "¿Cómo crear una cotización?",
            "¿Cómo contactar soporte?",
            "¿Dónde ver mis quejas?",
            "¿Cómo cerrar sesión?",
            "¿Dónde ver el mapa?"
        ];

        chatbotSuggestions.innerHTML = ""; // Limpia sugerencias previas

        questions.forEach((question) => {
            const button = document.createElement("button");
            button.textContent = question;
            button.classList.add("chatbot-suggestion");
            button.addEventListener("click", function () {
                appendMessage("Tú", question);
                setTimeout(() => respondToUser(question), 500);
            });
            chatbotSuggestions.appendChild(button);
        });
    }

    // Llamar a la función para mostrar las preguntas al cargar el chat
    addSuggestedQuestions();
});
