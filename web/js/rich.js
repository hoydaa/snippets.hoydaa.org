function blind(id) {
  if(document.blind_arr == null) {
    document.blind_arr = [];
  }
  if(document.blind_arr[id] == null || document.blind_arr[id] == 'blindup') {
    Effect.BlindUp(id);
    document.blind_arr[id] = 'blinddown';
  } else if(document.blind_arr[id] == 'blinddown'){
    Effect.BlindDown(id);
    document.blind_arr[id] = 'blindup';		
  }
}