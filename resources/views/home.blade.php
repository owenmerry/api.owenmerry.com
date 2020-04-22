<div>
api.owenmerry.com - home second
Instagram (code: {{ request()->input('code') }}):

<div>
<form type='GET'>
  <div>Instagram Code: </div>
  <input type='text' name='code' value='{{ request()->input('code') }}'>
  <input type='hidden' name='token' value='{{ request()->input('token') }}'>
  <input type='hidden' name='imageid' value='{{ request()->input('imageid') }}'>
  <input type='hidden' name='pagetokennext' value='{{ request()->input('pagetokennext') }}'>
  <input type='hidden' name='pagetokenprevious' value='{{ request()->input('pagetokenprevious') }}'>
  <button type='submit' text='add'>Add code</button>
</form>
<form type='GET'>
  <div>Instagram Token: </div>
  <input type='text' name='token' value='{{ request()->input('token') }}'>
  <input type='hidden' name='code' value='{{ request()->input('code') }}'>
  <input type='hidden' name='imageid' value='{{ request()->input('imageid') }}'>
  <input type='hidden' name='pagetokennext' value='{{ request()->input('pagetokennext') }}'>
  <input type='hidden' name='pagetokenprevious' value='{{ request()->input('pagetokenprevious') }}'>
  <button type='submit' text='add'>Add token</button>
</form>
<form type='GET'>
  <div>Instagram ImageID: </div>
  <input type='text' name='imageid' value='{{ request()->input('imageid') }}'>
  <input type='hidden' name='token' value='{{ request()->input('token') }}'>
  <input type='hidden' name='code' value='{{ request()->input('code') }}'>
  <input type='hidden' name='pagetokennext' value='{{ request()->input('pagetokennext') }}'>
  <input type='hidden' name='pagetokenprevious' value='{{ request()->input('pagetokenprevious') }}'>
  <button type='submit' text='add'>Add imageid</button>
</form>
<form type='GET'>
  <div>Instagram Media Pages: </div>
  After:<input type='text' name='pagetokennext' value='{{ request()->input('pagetokennext') }}'> <br />
  Before:<input type='text' name='pagetokenprevious' value='{{ request()->input('pagetokenprevious') }}'><br />
  <input type='hidden' name='token' value='{{ request()->input('token') }}'>
  <input type='hidden' name='code' value='{{ request()->input('code') }}'>
  <input type='hidden' name='imageid' value='{{ request()->input('imageid') }}'>
  <button type='submit' text='add'>Add Page</button>
</form>
</div>

<div>Auth</div>
<div><a href='./api/photos/instagram/auth?code={{ request()->input('code') }}'>Auth</a></div>
<div>User</div>
<div><a href='./api/photos/instagram/me?token={{ request()->input('token') }}'>Me</a></div>
<div>Media</div>
<div><a href='./api/photos/instagram/media?token={{ request()->input('token') }}'>Media</a></div>
<div><a href='./api/photos/fake/instagram/media?token={{ request()->input('token') }}'>Media (Fake)</a></div>
<div><a href='./api/photos/instagram/media/next/{{ request()->input('pagetokennext') }}?token={{ request()->input('token') }}'>Media Next</a></div>
<div><a href='./api/photos/instagram/media/previous/{{ request()->input('pagetokenprevious') }}?token={{ request()->input('token') }}'>Media Previous</a></div>
<div>Image</div>
<div><a href='./api/photos/instagram/image/{{ request()->input('imageid') }}?token={{ request()->input('token') }}'>Image</a></div>
<div>Token</div>
<div><a href='./api/photos/instagram/long-live-token?token={{ request()->input('token') }}'>Long Live Token</a></div>
<div><a href='./api/photos/instagram/refresh-long-live-token?token={{ request()->input('token') }}'>Refresh Long Live Token</a></div>
</div>
