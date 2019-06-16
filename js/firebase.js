$("#imp_park").on('click',function(){
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyABY8rm1P52cBHxzGm9GTE-RrB9RoezieQ",
    authDomain: "impulse-b25bf.firebaseapp.com",
    databaseURL: "https://impulse-b25bf.firebaseio.com",
    projectId: "impulse-b25bf",
    storageBucket: "impulse-b25bf.appspot.com",
    messagingSenderId: "742904019006"
  };
  var uid = '2'
  firebase.initializeApp(config);
  var dbRefObject = firebase.database().ref("root");
  dbRefObject.once('value').then(function(snapshot) {
  	console.log(snapshot.child(uid).val())
  });
});