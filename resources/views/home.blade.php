<div>
api.owenmerry.com - home second
<script>
//fetch('http://local.api.owenmerry.com/api/photos/instagram/setAccessToken/hereisthetoken2')
fetch('http://local.api.owenmerry.com/api/photos/instagram/accessToken')
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    console.log('get:',data);
  });

  fetch('http://local.api.owenmerry.com/api/photos/instagram/setAccessToken/addedthisdataintothesession')
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    console.log('set:',data);
  });
</script>
</div>