importScripts("https://www.gstatic.com/firebasejs/4.9.0/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/4.9.0/firebase-messaging.js");
  
  var config = {
    apiKey: "AIzaSyDNFQ3fEcYylZ2wVVkxYV4Ch-FB-TwQsdY",
    authDomain: "qiseventos.firebaseapp.com",
    databaseURL: "https://qiseventos.firebaseio.com",
    projectId: "qiseventos",
    storageBucket: "",
    messagingSenderId: "330761437937"
  };
  firebase.initializeApp(config);
 
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload){
  const notificationTitle = 'QISeventos';
  const notificationOptions = {
    body: 'Você tem uma nova notificação.',
    icon: '../img/favicon.png',
    badge: '../img/icone_badge.png',
  };
  return self.registration.showNotification(notificationTitle, notificationOptions);

});

self.addEventListener('notificationclick', function(event) {

  event.notification.close();

  event.waitUntil(
    clients.openWindow('../../index.php')
  );
});