 <!-- Chatbox -->
 <div class="chatbox-container">
     <button class="chat-button" onclick="toggleChat()">💬</button>
     <div class="chatbox" id="chatbox">
         <div class="chat-header">
             <h3>Hỗ Trợ Trực Tuyến</h3>
             <button class="close-chat" onclick="toggleChat()">×</button>
         </div>
         <div class="chat-messages" id="chatMessages">
             <div class="message bot">
                 Xin chào! Chào mừng bạn đến với CFPLUS . Tôi có thể giúp gì cho bạn?
             </div>
         </div>
         <div class="chat-input-container">
             <input type="text" class="chat-input" id="chatInput" placeholder="Nhập tin nhắn..."
                 onkeypress="handleKeyPress(event)">
             <button class="send-button" onclick="sendMessage()">Gửi</button>
         </div>
     </div>
 </div>

 <script>
function toggleChat() {
    const chatbox = document.getElementById('chatbox');
    chatbox.classList.toggle('active');
}

function handleKeyPress(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
}

function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();

    if (message === '') return;

    const messagesContainer = document.getElementById('chatMessages');

    // Add user message
    const userMessage = document.createElement('div');
    userMessage.className = 'message user';
    userMessage.textContent = message;
    messagesContainer.appendChild(userMessage);

    input.value = '';

    // Scroll to bottom
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    // Simulate bot response
    setTimeout(() => {
        const botMessage = document.createElement('div');
        botMessage.className = 'message bot';

        const lowerMessage = message.toLowerCase();
        if (lowerMessage.includes('giá') || lowerMessage.includes('bao nhiêu')) {
            botMessage.textContent =
                'Giá các sản phẩm của chúng tôi dao động từ 30.000đ - 50.000đ. Bạn muốn biết giá món nào cụ thể?';
        } else if (lowerMessage.includes('menu') || lowerMessage.includes('thực đơn')) {
            botMessage.textContent =
                'Chúng tôi có cafe các loại, bánh ngọt, trà sữa và nhiều món khác. Bạn có thể xem thực đơn chi tiết ở mục "Thực Đơn" nhé!';
        } else if (lowerMessage.includes('giao hàng') || lowerMessage.includes('ship')) {
            botMessage.textContent =
                'Chúng tôi giao hàng miễn phí trong bán kính 3km, thời gian giao hàng khoảng 30 phút. Phí ship 15.000đ cho khu vực xa hơn.';
        } else if (lowerMessage.includes('giờ') || lowerMessage.includes('mở cửa')) {
            botMessage.textContent =
                'Cửa hàng mở cửa từ 7:00 sáng đến 10:00 tối hàng ngày. Chào đón bạn ghé thăm!';
        } else {
            botMessage.textContent =
                'Cảm ơn bạn đã liên hệ! Nhân viên sẽ phản hồi trong giây lát. Hoặc bạn có thể gọi hotline: 1900 xxxx để được hỗ trợ nhanh hơn.';
        }

        messagesContainer.appendChild(botMessage);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }, 1000);
}
 </script>