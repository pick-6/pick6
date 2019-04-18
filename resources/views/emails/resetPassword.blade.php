<tr>
   <td style="word-wrap:break-word;font-size:0px;padding:0px 15px 0px 15px;" align="center">
      <div style="cursor:auto;color:#eee;font-family:Montserrat,'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:15px;text-align:center;">
         <h3 style="font-family: Montserrat,'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 24px; color: #eee;margin:10px;text-transform:uppercase">{{$title}}</h3>
      </div>
   </td>
</tr>
<tr>
   <td style="word-wrap:break-word;font-size:0px;padding:0px 25px;" align="center">
      <div style="cursor:auto;color:#eee;font-family:Montserrat,'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:15px;line-height:22px;text-align:center;">
         <p>Forgot your password? No problem. <br /> Click the button below to set up a new password.</p>
      </div>
   </td>
</tr>
<tr>
   <td style="word-wrap:break-word;font-size:0px;padding:20px 25px 20px 25px;padding-top:10px;padding-left:25px;" align="center">
       <a href="{{ url('/password/reset/'.$token) }}" style="text-decoration: none; background: #5cb85c; color: #000; font-family: Montserrat,'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 15px; font-weight: bold; line-height: 120%; text-transform: uppercase; margin: 0px;" target="_blank">
          <table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;" align="center" border="0">
             <tbody>
                <tr>
                   <td style="border:none;border-radius:5px;color:#000;cursor:auto;padding:10px 25px;" align="center" valign="middle" bgcolor="#5cb85c">
                           Reset Password
                   </td>
                </tr>
             </tbody>
          </table>
      </a>
   </td>
</tr>
