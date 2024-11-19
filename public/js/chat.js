document.addEventListener("DOMContentLoaded", () => {
    const apiUrl = 'https://chat-ues-production.up.railway.app/messages'; 
    const chatBox = document.getElementById('chat-box');
    const inputMessage = document.getElementById('input-message');
    const sendButton = document.getElementById('send-button');

    async function loadMessages() {
        try {
            const response = await fetch(apiUrl);
            if (!response.ok) throw new Error('Error al obtener mensajes');
            const messages = await response.json();
            messages.forEach(msg => appendMessage(msg.message || 'Mensaje vacío'));
        } catch (error) {
            console.error('Error cargando mensajes:', error);
            appendMessage('Error al cargar mensajes.');
        }
    }

    async function sendMessage(message) {
        try {
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ message }),
            });
            if (!response.ok) throw new Error('Error al enviar el mensaje');
            appendMessage(`Tú: ${message}`);
            appendMessage('Mensaje enviado');
        } catch (error) {
            console.error('Error enviando mensaje:', error);
            appendMessage('Error al enviar el mensaje.');
        }
    }

    function appendMessage(message) {
        const messageElement = document.createElement('div');
        messageElement.textContent = message;
        messageElement.className = 'mb-2 p-2 bg-gray-100 rounded shadow-sm';
        chatBox.appendChild(messageElement);
        chatBox.scrollTop = chatBox.scrollHeight; 
    }


    sendButton.addEventListener('click', () => {
        const message = inputMessage.value.trim();
        if (message) {
            sendMessage(message);
            inputMessage.value = ''; 
        }
    });
    inputMessage.addEventListener('keypress', (event) => {
        if (event.key === 'Enter') {
            sendButton.click();
        }
    });

    loadMessages();
});
