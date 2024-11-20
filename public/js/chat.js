let selectedChatId = null;

    const socket = new WebSocket("https://chat-ues-production.up.railway.app");

    socket.onopen = () => {
        console.log("Conexión establecida con el WebSocket.");
    };

    socket.onmessage = (event) => {
        const messageData = JSON.parse(event.data);

        if (messageData.chatId === selectedChatId) {
            const messageContainer = document.getElementById('messageContainer');
            const messageClass = messageData.sender === 'me' ? 'sent' : 'received';
            messageContainer.innerHTML += `
                <div class="message ${messageClass}">
                    ${messageData.text}
                    <small class="text-muted">${messageData.time}</small>
                </div>
            `;
            messageContainer.scrollTop = messageContainer.scrollHeight;
        }
    };

    socket.onclose = () => {
        console.log("Conexión cerrada.");
    };

    socket.onerror = (error) => {
        console.error("Error en el WebSocket:", error);
    };


    document.addEventListener('DOMContentLoaded', () => {
        fetch('/api/users')
            .then(response => response.json())
            .then(users => {
                const chatList = document.getElementById('chatList');
                chatList.innerHTML = ''; 
                users.forEach(user => {
                    chatList.innerHTML += `
                        <div class="chat-item rounded-3" onclick="selectChat(${user.id}, '${user.name}', '${user.role || 'Sin Rol'}')">
                            <img src="https://via.placeholder.com/40" alt="User">
                            <div>
                                <strong>${user.name}</strong><br>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error al obtener los usuarios:', error));
    });

    function selectChat(userId, userName, userRole) {
        selectedChatId = userId;

        document.getElementById('chatName').textContent = userName;

        const messageContainer = document.getElementById('messageContainer');
        messageContainer.innerHTML = '<p class="text-center text-muted">Cargando mensajes...</p>';


        fetch(`/api/chats/${userId}/messages`)
            .then(response => response.json())
            .then(messages => {
                messageContainer.innerHTML = ''; 
                messages.forEach(message => {
                    const messageClass = message.sender === 'me' ? 'sent' : 'received';
                    messageContainer.innerHTML += `
                        <div class="message ${messageClass}">
                            ${message.text}
                            <small class="text-muted">${message.time}</small>
                        </div>
                    `;
                });
                messageContainer.scrollTop = messageContainer.scrollHeight;
            })
            .catch(error => {
                console.error('Error al cargar mensajes:', error);
                messageContainer.innerHTML = '<p class="text-center text-danger">Error al cargar mensajes</p>';
            });
    }

    function sendMessage(event) {
        if (event.key === 'Enter' || event.type === 'click') {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();
            if (message !== '' && selectedChatId !== null) {
                const time = new Date().toLocaleTimeString();
                const data = { chatId: selectedChatId, text: message, sender: 'me', time: time };

                socket.send(JSON.stringify(data));


                const messageContainer = document.getElementById('messageContainer');
                messageContainer.innerHTML += `
                    <div class="message sent">
                        ${message}
                        <small class="text-muted">${time}</small>
                    </div>
                `;
                input.value = ''; 
                messageContainer.scrollTop = messageContainer.scrollHeight; 
            }
        }
    }
