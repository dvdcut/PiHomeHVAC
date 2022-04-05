<?php 
/*
             __  __                             _
            |  \/  |                    /\     (_)
            | \  / |   __ _  __  __    /  \     _   _ __
            | |\/| |  / _` | \ \/ /   / /\ \   | | |  __|
            | |  | | | (_| |  >  <   / ____ \  | | | |
            |_|  |_|  \__,_| /_/\_\ /_/    \_\ |_| |_|

                   S M A R T   T H E R M O S T A T

*************************************************************************"
* MaxAir is a Linux based Central Heating Control systems. It runs from *"
* a web interface and it comes with ABSOLUTELY NO WARRANTY, to the      *"
* extent permitted by applicable law. I take no responsibility for any  *"
* loss or damage to you or your property.                               *"
* DO NOT MAKE ANY CHANGES TO YOUR HEATING SYSTEM UNTILL UNLESS YOU KNOW *"
* WHAT YOU ARE DOING                                                    *"
*************************************************************************"
*/
require_once(__DIR__.'/st_inc/session.php');
confirm_logged_in();
require_once(__DIR__.'/st_inc/connection.php');
require_once(__DIR__.'/st_inc/functions.php');

if(!isset($_GET['Ajax'])){
    //Check this once, instead of everytime. Should be more efficient.
    //if($DEBUG==true)
    //{
        var_dump($_GET);
        echo '<br />';
    //}
    echo __FILE__ . ' ' . __LINE__ . ' Error: Ajax action is not set.';
    return;
}

function GetModal_OpenWeather($conn){
	global $lang;
	//foreach($_GET as $variable => $value) echo $variable . "&nbsp;=&nbsp;" . $value . "<br />\r\n";

    echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h5 class="modal-title" id="ajaxModalLabel">'.$lang['openweather_settings'].'</h5>
        </div>
        <div class="modal-body" id="ajaxModalBody">
            <p class="text-muted">'.$lang['openweather_text1'].' <a class="green" target="_blank" href="http://OpenWeatherMap.org">'.$lang['openweather_text2'].'</a> '.$lang['openweather_text3'].'
            <p>'.$lang['openweather_text4'].'

            <form name="form-openweather" id="form-openweather" role="form" onSubmit="return false;" action="javascript:return false;" >
            <div class="form-group">
                <label>Country</label>&nbsp;(ISO-3166-1: Alpha-2 Codes)
                <select class="form-control" id="sel_Country" name="sel_Country" >
                    <option value="AF">Afghanistan</option>
                    <option value="AX">Åland Islands</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AS">American Samoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AQ">Antarctica</option>
                    <option value="AG">Antigua and Barbuda</option>
                    <option value="AR">Argentina</option>
                    <option value="AM">Armenia</option>
                    <option value="AW">Aruba</option>
                    <option value="AU">Australia</option>
                    <option value="AT">Austria</option>
                    <option value="AZ">Azerbaijan</option>
                    <option value="BS">Bahamas</option>
                    <option value="BH">Bahrain</option>
                    <option value="BD">Bangladesh</option>
                    <option value="BB">Barbados</option>
                    <option value="BY">Belarus</option>
                    <option value="BE">Belgium</option>
                    <option value="BZ">Belize</option>
                    <option value="BJ">Benin</option>
                    <option value="BM">Bermuda</option>
                    <option value="BT">Bhutan</option>
                    <option value="BO">Bolivia, Plurinational State of</option>
                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                    <option value="BA">Bosnia and Herzegovina</option>
                    <option value="BW">Botswana</option>
                    <option value="BV">Bouvet Island</option>
                    <option value="BR">Brazil</option>
                    <option value="IO">British Indian Ocean Territory</option>
                    <option value="BN">Brunei Darussalam</option>
                    <option value="BG">Bulgaria</option>
                    <option value="BF">Burkina Faso</option>
                    <option value="BI">Burundi</option>
                    <option value="KH">Cambodia</option>
                    <option value="CM">Cameroon</option>
                    <option value="CA">Canada</option>
                    <option value="CV">Cape Verde</option>
                    <option value="KY">Cayman Islands</option>
                    <option value="CF">Central African Republic</option>
                    <option value="TD">Chad</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CX">Christmas Island</option>
                    <option value="CC">Cocos (Keeling) Islands</option>
                    <option value="CO">Colombia</option>
                    <option value="KM">Comoros</option>
                    <option value="CG">Congo</option>
                    <option value="CD">Congo, the Democratic Republic of the</option>
                    <option value="CK">Cook Islands</option>
                    <option value="CR">Costa Rica</option>
                    <option value="CI">Côte d\'Ivoire</option>
                    <option value="HR">Croatia</option>
                    <option value="CU">Cuba</option>
                    <option value="CW">Curaçao</option>
                    <option value="CY">Cyprus</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="DK">Denmark</option>
                    <option value="DJ">Djibouti</option>
                    <option value="DM">Dominica</option>
                    <option value="DO">Dominican Republic</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Egypt</option>
                    <option value="SV">El Salvador</option>
                    <option value="GQ">Equatorial Guinea</option>
                    <option value="ER">Eritrea</option>
                    <option value="EE">Estonia</option>
                    <option value="ET">Ethiopia</option>
                    <option value="FK">Falkland Islands (Malvinas)</option>
                    <option value="FO">Faroe Islands</option>
                    <option value="FJ">Fiji</option>
                    <option value="FI">Finland</option>
                    <option value="FR">France</option>
                    <option value="GF">French Guiana</option>
                    <option value="PF">French Polynesia</option>
                    <option value="TF">French Southern Territories</option>
                    <option value="GA">Gabon</option>
                    <option value="GM">Gambia</option>
                    <option value="GE">Georgia</option>
                    <option value="DE">Germany</option>
                    <option value="GH">Ghana</option>
                    <option value="GI">Gibraltar</option>
                    <option value="GR">Greece</option>
                    <option value="GL">Greenland</option>
                    <option value="GD">Grenada</option>
                    <option value="GP">Guadeloupe</option>
                    <option value="GU">Guam</option>
                    <option value="GT">Guatemala</option>
                    <option value="GG">Guernsey</option>
                    <option value="GN">Guinea</option>
                    <option value="GW">Guinea-Bissau</option>
                    <option value="GY">Guyana</option>
                    <option value="HT">Haiti</option>
                    <option value="HM">Heard Island and McDonald Islands</option>
                    <option value="VA">Holy See (Vatican City State)</option>
                    <option value="HN">Honduras</option>
                    <option value="HK">Hong Kong</option>
                    <option value="HU">Hungary</option>
                    <option value="IS">Iceland</option>
                    <option value="IN">India</option>
                    <option value="ID">Indonesia</option>
                    <option value="IR">Iran, Islamic Republic of</option>
                    <option value="IQ">Iraq</option>
                    <option value="IE">Ireland</option>
                    <option value="IM">Isle of Man</option>
                    <option value="IL">Israel</option>
                    <option value="IT">Italy</option>
                    <option value="JM">Jamaica</option>
                    <option value="JP">Japan</option>
                    <option value="JE">Jersey</option>
                    <option value="JO">Jordan</option>
                    <option value="KZ">Kazakhstan</option>
                    <option value="KE">Kenya</option>
                    <option value="KI">Kiribati</option>
                    <option value="KP">Korea, Democratic People\'s Republic of</option>
                    <option value="KR">Korea, Republic of</option>
                    <option value="KW">Kuwait</option>
                    <option value="KG">Kyrgyzstan</option>
                    <option value="LA">Lao People\'s Democratic Republic</option>
                    <option value="LV">Latvia</option>
                    <option value="LB">Lebanon</option>
                    <option value="LS">Lesotho</option>
                    <option value="LR">Liberia</option>
                    <option value="LY">Libya</option>
                    <option value="LI">Liechtenstein</option>
                    <option value="LT">Lithuania</option>
                    <option value="LU">Luxembourg</option>
                    <option value="MO">Macao</option>
                    <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                    <option value="MG">Madagascar</option>
                    <option value="MW">Malawi</option>
                    <option value="MY">Malaysia</option>
                    <option value="MV">Maldives</option>
                    <option value="ML">Mali</option>
                    <option value="MT">Malta</option>
                    <option value="MH">Marshall Islands</option>
                    <option value="MQ">Martinique</option>
                    <option value="MR">Mauritania</option>
                    <option value="MU">Mauritius</option>
                    <option value="YT">Mayotte</option>
                    <option value="MX">Mexico</option>
                    <option value="FM">Micronesia, Federated States of</option>
                    <option value="MD">Moldova, Republic of</option>
                    <option value="MC">Monaco</option>
                    <option value="MN">Mongolia</option>
                    <option value="ME">Montenegro</option>
                    <option value="MS">Montserrat</option>
                    <option value="MA">Morocco</option>
                    <option value="MZ">Mozambique</option>
                    <option value="MM">Myanmar</option>
                    <option value="NA">Namibia</option>
                    <option value="NR">Nauru</option>
                    <option value="NP">Nepal</option>
                    <option value="NL">Netherlands</option>
                    <option value="NC">New Caledonia</option>
                    <option value="NZ">New Zealand</option>
                    <option value="NI">Nicaragua</option>
                    <option value="NE">Niger</option>
                    <option value="NG">Nigeria</option>
                    <option value="NU">Niue</option>
                    <option value="NF">Norfolk Island</option>
                    <option value="MP">Northern Mariana Islands</option>
                    <option value="NO">Norway</option>
                    <option value="OM">Oman</option>
                    <option value="PK">Pakistan</option>
                    <option value="PW">Palau</option>
                    <option value="PS">Palestinian Territory, Occupied</option>
                    <option value="PA">Panama</option>
                    <option value="PG">Papua New Guinea</option>
                    <option value="PY">Paraguay</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Philippines</option>
                    <option value="PN">Pitcairn</option>
                    <option value="PL">Poland</option>
                    <option value="PT">Portugal</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="QA">Qatar</option>
                    <option value="RE">Réunion</option>
                    <option value="RO">Romania</option>
                    <option value="RU">Russian Federation</option>
                    <option value="RW">Rwanda</option>
                    <option value="BL">Saint Barthélemy</option>
                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                    <option value="KN">Saint Kitts and Nevis</option>
                    <option value="LC">Saint Lucia</option>
                    <option value="MF">Saint Martin (French part)</option>
                    <option value="PM">Saint Pierre and Miquelon</option>
                    <option value="VC">Saint Vincent and the Grenadines</option>
                    <option value="WS">Samoa</option>
                    <option value="SM">San Marino</option>
                    <option value="ST">Sao Tome and Principe</option>
                    <option value="SA">Saudi Arabia</option>
                    <option value="SN">Senegal</option>
                    <option value="RS">Serbia</option>
                    <option value="SC">Seychelles</option>
                    <option value="SL">Sierra Leone</option>
                    <option value="SG">Singapore</option>
                    <option value="SX">Sint Maarten (Dutch part)</option>
                    <option value="SK">Slovakia</option>
                    <option value="SI">Slovenia</option>
                    <option value="SB">Solomon Islands</option>
                    <option value="SO">Somalia</option>
                    <option value="ZA">South Africa</option>
                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                    <option value="SS">South Sudan</option>
                    <option value="ES">Spain</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="SD">Sudan</option>
                    <option value="SR">Suriname</option>
                    <option value="SJ">Svalbard and Jan Mayen</option>
                    <option value="SZ">Swaziland</option>
                    <option value="SE">Sweden</option>
                    <option value="CH">Switzerland</option>
                    <option value="SY">Syrian Arab Republic</option>
                    <option value="TW">Taiwan, Province of China</option>
                    <option value="TJ">Tajikistan</option>
                    <option value="TZ">Tanzania, United Republic of</option>
                    <option value="TH">Thailand</option>
                    <option value="TL">Timor-Leste</option>
                    <option value="TG">Togo</option>
                    <option value="TK">Tokelau</option>
                    <option value="TO">Tonga</option>
                    <option value="TT">Trinidad and Tobago</option>
                    <option value="TN">Tunisia</option>
                    <option value="TR">Turkey</option>
                    <option value="TM">Turkmenistan</option>
                    <option value="TC">Turks and Caicos Islands</option>
                    <option value="TV">Tuvalu</option>
                    <option value="UG">Uganda</option>
                    <option value="UA">Ukraine</option>
                    <option value="AE">United Arab Emirates</option>
                    <option value="GB">United Kingdom</option>
                    <option value="US">United States</option>
                    <option value="UM">United States Minor Outlying Islands</option>
                    <option value="UY">Uruguay</option>
                    <option value="UZ">Uzbekistan</option>
                    <option value="VU">Vanuatu</option>
                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                    <option value="VN">Viet Nam</option>
                    <option value="VG">Virgin Islands, British</option>
                    <option value="VI">Virgin Islands, U.S.</option>
                    <option value="WF">Wallis and Futuna</option>
                    <option value="EH">Western Sahara</option>
                    <option value="YE">Yemen</option>
                    <option value="ZM">Zambia</option>
                    <option value="ZW">Zimbabwe</option>
                </select>
            </div>
            <div class="form-group">
                <label>City or Zip</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="rad_CityZip" id="rad_CityZip_City" value="City" onchange="rad_CityZip_Changed();">
                  City
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="rad_CityZip" id="rad_CityZip_Zip" value="Zip" onchange="rad_CityZip_Changed();">
                  Zip
                </div>
            </div>
            <div class="form-group CityZip City">
                <label>City:</label>
                <input type="text" class="form-control" name="inp_City" id="inp_City">
            </div>
            <div class="form-group CityZip Zip">
                <label>Zip:</label>
                <input type="text" class="form-control" name="inp_Zip" id="inp_Zip">
            </div>
            <div class="form-group">
                <label>API Key:</label>
                <input type="text" class="form-control" name="inp_APIKEY" id="inp_APIKEY">
            </div>
            </form>';
    echo '</div>';      //close class="modal-body">
    echo '<div class="modal-footer" id="ajaxModalFooter">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">'.$lang['cancel'].'</button>
            <input type="button" name="submit" value="'.$lang['save'].'" class="btn btn-default login btn-sm" onclick="update_openweather()">
        </div>';      //close class="modal-footer">

    echo '<script language="javascript" type="text/javascript">
        rad_CityZip_Changed=function() {
            if($(\'#form-openweather [name="rad_CityZip"]:checked\').val()=="City") {
                $(".CityZip").hide();
                $(".CityZip.City").show();
            }
            else {
                $(".CityZip").hide();
                $(".CityZip.Zip").show();
            }
        };
        $("#sel_Country").val("' . settings($conn,'country') . '");
        $("#inp_APIKEY").val("' . settings($conn,'openweather_api') . '");';
    $City=settings($conn,'city');
    if($City!=NULL) {
        echo '$(\'#form-openweather [name="rad_CityZip"]\').val(["City"]);';
        echo '$("#inp_City").val("' . $City . '");';
    }else {
        echo '$(\'#form-openweather [name="rad_CityZip"]\').val(["Zip"]);';
        echo '$("#inp_Zip").val("' . settings($conn,'zip') . '");';
    }
    echo 'rad_CityZip_Changed();
        update_openweather=function(){
            var idata="w=openweather&o=update";
            idata+="&"+$("#form-openweather").serialize();
            $.get("db.php",idata)
            .done(function(odata){
                if(odata.Success)
                    $("#ajaxModal").modal("hide");
                else
                    alert(odata.Message);
            })
            .fail(function( jqXHR, textStatus, errorThrown ){
                if(jqXHR==401 || jqXHR==403) return;
                alert("update_openweather: Error.\r\n\r\njqXHR: "+jqXHR+"\r\n\r\ntextStatus: "+textStatus+"\r\n\r\nerrorThrown:"+errorThrown);
            })
            .always(function() {
            });
        }
    </script>';

    return;
}
if($_GET['Ajax']=='GetModal_OpenWeather')
{
    GetModal_OpenWeather($conn);
    return;
}


function GetModal_System($conn)
{
        global $lang;
	//foreach($_GET as $variable => $value) echo $variable . "&nbsp;=&nbsp;" . $value . "<br />\r\n";
    //System temperature
    echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h5 class="modal-title" id="ajaxModalLabel">'.$lang['cpu_temperature'].'</h5>
        </div>
        <div class="modal-body" id="ajaxModalBody">
    <p class="text-muted"> '.$lang['cpu_temperature_text'].' </p>';
    $query = "select * from messages_in where node_id = 0 order by datetime desc limit 5";
    $results = $conn->query($query);
    echo '<div class="list-group">';
    while ($row = mysqli_fetch_assoc($results)) {
        echo '<span class="list-group-item">
        <i class="fa fa-server fa-1x green"></i> '.$row['datetime'].'
        <span class="pull-right text-muted small"><em>'.number_format(DispSensor($conn,$row['payload'],1),1).'&deg;</em></span>
        </span>';
    }
    echo '</div>';      //close class="list-group">';
    echo '</div>';      //close class="modal-body">
    echo '<div class="modal-footer" id="ajaxModalFooter">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">'.$lang['close'].'</button>
        </div>';      //close class="modal-footer">
    return;
}
if($_GET['Ajax']=='GetModal_System')
{
    GetModal_System($conn);
    return;
}



function GetModal_MQTT($conn)
{
        global $lang;
	//foreach($_GET as $variable => $value) echo $variable . "&nbsp;=&nbsp;" . $value . "<br />\r\n";

    echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h5 class="modal-title" id="ajaxModalLabel">'.$lang['mqtt_connections'].'</h5>
            <div class="dropdown pull-right">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-file fa-fw"></i><i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu">
                        <li><a href="pdf_download.php?file=setup_guide_mqtt.pdf" target="_blank"><i class="fa fa-file fa-fw"></i>'.$lang['setup_guide_mqtt'].'</a></li>
                        <li class="divider"></li>
                        <li><a href="pdf_download.php?file=setup_zigbee2mqtt.pdf" target="_blank"><i class="fa fa-file fa-fw"></i>'.$lang['setup_zigbee2mqtt'].'</a></li>
                </ul>
             </div>
        </div>
        <div class="modal-body" id="ajaxModalBody">';
    $query = "SELECT * FROM `mqtt` ORDER BY `name`;";
    $results = $conn->query($query);
    echo '<div class="list-group">';
    echo '<span class="list-group-item" style="height:40px;">&nbsp;';
    echo '<span class="pull-right text-muted small"><button type="button" class="btn btn-primary btn-sm" 
             data-remote="false" data-target="#ajaxModal" data-ajax="ajax.php?Ajax=GetModal_MQTTAdd" onclick="mqtt_AddEdit(this);">'.$lang['add'].'</button></span>';
    echo '</span>';
    while ($row = mysqli_fetch_assoc($results)) {
        echo '<span class="list-group-item">';
        echo $row['name'] . ($row['enabled'] ? '' : ' (Disabled)');
        echo '<span class="pull-right text-muted small" style="width:200px;text-align:right;">Username:&nbsp;' . $row['username'] . '</span>';
        echo '<br/><span class="text-muted small">Type:&nbsp;';
        if($row['type']==0) echo 'Default, monitor.';
        else if($row['type']==1) echo 'Sonoff Tasmota.';
        else if($row['type']==2) echo 'MQTT Node.';
        else if($row['type']==3) echo 'Home Assistant.';
        else echo 'Unknown.';
        echo '</span>';
        echo '<span class="pull-right text-muted small" style="width:200px;text-align:right;">Password:&nbsp;' . dec_passwd($row['password']) . '</span>';
        echo '<br/><span class="text-muted small">' . $row['ip'] . '&nbsp;:&nbsp;' . $row['port'] . '</span>';

        echo '<span class="pull-right text-muted small" style="width:200px;text-align:right;">';
        echo '<button class="btn btn-default btn-xs" data-remote="false" data-target="#ajaxModal" data-ajax="ajax.php?Ajax=GetModal_MQTTEdit&id=' . $row['id'] . '" onclick="mqtt_AddEdit(this);">
            <span class="ionicons ion-edit"></span></button>&nbsp;&nbsp;
		<button class="btn btn-danger btn-xs" onclick="mqtt_delete(' . $row['id'] . ');"><span class="glyphicon glyphicon-trash"></span></button>';
        echo '</span>';
        echo '</span>';
    }
    echo '</div>';      //close class="list-group">';
    echo '</div>';      //close class="modal-body">
    echo '<div class="modal-footer" id="ajaxModalFooter">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">'.$lang['close'].'</button>
        </div>';      //close class="modal-footer">
    echo '<script language="javascript" type="text/javascript">
        mqtt_AddEdit=function(ithis){ $("#ajaxModal").one("hidden.bs.modal", function() { $("#ajaxModal").modal("show",$(ithis)); }).modal("hide");};
    </script>';
    return;
}
if($_GET['Ajax']=='GetModal_MQTT')
{
    GetModal_MQTT($conn);
    return;
}
function GetModal_MQTTAddEdit($conn)
{
        global $lang;
	//foreach($_GET as $variable => $value) echo $variable . "&nbsp;=&nbsp;" . $value . "<br />\r\n";

    $IsAdd=true;
    if(isset($_GET['id'])) {
        $query = "SELECT * FROM `mqtt` WHERE `id`=" . $_GET['id'] . ";";
        $results = $conn->query($query);
        $row = mysqli_fetch_assoc($results);
        $IsAdd=false;
    }

    echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h5 class="modal-title" id="ajaxModalLabel">' . ($IsAdd ? $lang['add_mqtt_connection'] : $lang['edit_mqtt_connection']) . '</h5>
        </div>
        <div class="modal-body" id="ajaxModalBody">';


    echo '<form name="form-mqtt" id="form-mqtt" role="form" onSubmit="return false;" action="javascript:return false;" >
            ' . ($IsAdd ? '' : '<input type="hidden" name="inp_id" id="inp_id" value="' . $row['id'] . '">') . '
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="inp_Name" id="inp_Name" value="' . ($IsAdd ? '' : $row['name']) . '">
            </div>
            <div class="form-group">
                <label>IP</label>
                <input type="text" class="form-control" name="inp_IP" id="inp_IP" value="' . ($IsAdd ? '' : $row['ip']) . '">
            </div>
            <div class="form-group">
                <label>Port</label>
                <input type="text" class="form-control" name="inp_Port" id="inp_Port" value="' . ($IsAdd ? '' : $row['port']) . '">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="inp_Username" id="inp_Username" value="' . ($IsAdd ? '' : $row['username']) . '">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="inp_Password" id="inp_Password" value="' . ($IsAdd ? '' : dec_passwd($row['password'])) . '">
            </div>
            <div class="form-group">
                <label>Enabled</label>
                <select class="form-control" id="sel_Enabled" name="sel_Enabled" >
                    <option value="0" ' . ($IsAdd ? '' : ($row['enabled'] ? 'selected' : '')) . '>'.$lang['disabled'].'</option>
                    <option value="1" ' . ($IsAdd ? '' : ($row['enabled'] ? 'selected' : '')) . '>'.$lang['enabled'].'</option>
                </select>
            </div>
            <div class="form-group">
                <label>Type</label>
                <select class="form-control" id="sel_Type" name="sel_Type" >
                    <option value="0" ' . ($IsAdd ? '' : ($row['type'] == "0" ? 'selected' : '')) . '>Default - view all</option>
                    <option value="1" ' . ($IsAdd ? '' : ($row['type'] == "1" ? 'selected' : '')) . '>Sonoff - Tasmota</option>
                    <option value="2" ' . ($IsAdd ? '' : ($row['type'] == "2" ? 'selected' : '')) . '>MQTT Node</option>
                    <option value="3" ' . ($IsAdd ? '' : ($row['type'] == "3" ? 'selected' : '')) . '>Home Assistant integration</option>
                </select>
            </div>
            </form>';
    echo '</div>';      //close class="modal-body">
    echo '<div class="modal-footer" id="ajaxModalFooter">' . ($IsAdd ?
            '<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal" onclick="mqtt_add()">'.$lang['add_conn'].'</button>'
            : '<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal" onclick="mqtt_edit()">'.$lang['edit_conn'].'</button>') . '
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">'.$lang['close'].'</button>
        </div>';      //close class="modal-footer">
    echo '<script language="javascript" type="text/javascript">
        mqtt_add=function(){
            var idata="w=mqtt&o=add";
            idata+="&"+$("#form-mqtt").serialize();
            $.get("db.php",idata)
            .done(function(odata){
                if(odata.Success)
                    $("#ajaxModal").modal("hide");
                else
                    alert(odata.Message);
            })
            .fail(function( jqXHR, textStatus, errorThrown ){
                if(jqXHR==401 || jqXHR==403) return;
                alert("mqtt_add: Error.\r\n\r\njqXHR: "+jqXHR+"\r\n\r\ntextStatus: "+textStatus+"\r\n\r\nerrorThrown:"+errorThrown);
            })
            .always(function() {
            });
        }
        mqtt_edit=function(){
            var idata="w=mqtt&o=edit";
            idata+="&"+$("#form-mqtt").serialize();
            $.get("db.php",idata)
            .done(function(odata){
                if(odata.Success)
                    $("#ajaxModal").modal("hide");
                else
                    alert(odata.Message);
            })
            .fail(function( jqXHR, textStatus, errorThrown ){
                if(jqXHR==401 || jqXHR==403) return;
                alert("mqtt_edit: Error.\r\n\r\njqXHR: "+jqXHR+"\r\n\r\ntextStatus: "+textStatus+"\r\n\r\nerrorThrown:"+errorThrown);
            })
            .always(function() {
            });
        }
    </script>';
    return;
}
if($_GET['Ajax']=='GetModal_MQTTEdit' || $_GET['Ajax']=='GetModal_MQTTAdd')
{
    GetModal_MQTTAddEdit($conn);
    return;
}



function GetModal_Services($conn)
{
	global $lang;
	//foreach($_GET as $variable => $value) echo $variable . "&nbsp;=&nbsp;" . $value . "<br />\r\n";

    echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h5 class="modal-title" id="ajaxModalLabel">'.$lang['services'].'</h5>
        </div>
        <div class="modal-body" id="ajaxModalBody">';
    $SArr=[['name'=>'Apache','service'=>'apache2.service'],
           ['name'=>'MySQL','service'=>'mysql.service'],
           ['name'=>'MariaDB','service'=>'mariadb.service'],
           ['name'=>'PiHome JOBS','service'=>'pihome_jobs_schedule.service'],
           ['name'=>'HomeAssistant Integration','service'=>'HA_integration.service'],
	   ['name'=>'Amazon Echo','service'=>'pihome_amazon_echo.service'],
           ['name'=>'Homebridge','service'=>'homebridge.service'],
           ['name'=>'Autohotspot','service'=>'autohotspot.service']];
    echo '<div class="list-group">';
    foreach($SArr as $SArrKey=>$SArrVal) {
        echo '<span class="list-group-item">';
        echo $SArrVal['name'];
        $rval=my_exec("/bin/systemctl status " . $SArrVal['service']);
        echo '<span class="pull-right text-muted small">';
        if($rval['stdout']=='') {
            echo 'Error: ' . $rval['stderr'];
        } else {
            $stat='Status: Unknown';
            $rval['stdout']=explode(PHP_EOL,$rval['stdout']);
            foreach($rval['stdout'] as $line) {
                if(strstr($line,'Loaded:')) {
                    if(strstr($line,'disabled;')) {
                        $stat='Status: Disabled';
                        break;
                    }
                }
                if(strstr($line,'Active:')) {
                    if(strstr($line,'active (running)')) {
                        $stat=trim($line);
                        break;
                    } else if(strstr($line,'(dead)')) {
                        $stat='Status: Dead';
                        break;
                    }
                }
            }
            echo $stat;
        }
        echo '</span>';
        echo '<br/>&nbsp;<span class="pull-right text-muted small" style="width:200px;text-align:right;">';
        echo '<button class="btn btn-default btn-xs" data-remote="false" data-target="#ajaxModal" data-ajax="ajax.php?Ajax=GetModal_ServicesInfo&id=' . $SArrVal['service'] . '" onclick="services_Info(this);">
            <span class="ionicons ion-ios-information-outline"></span></button>';
        echo '</span>';
        echo '</span>';
    }
    echo '</div>';      //close class="list-group">';
    echo '</div>';      //close class="modal-body">
    echo '<div class="modal-footer" id="ajaxModalFooter">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">'.$lang['close'].'</button>
        </div>';      //close class="modal-footer">
    echo '<script language="javascript" type="text/javascript">
        services_Info=function(ithis){ $("#ajaxModal").one("hidden.bs.modal", function() { $("#ajaxModal").modal("show",$(ithis)); }).modal("hide");};
    </script>';
    return;
}
if($_GET['Ajax']=='GetModal_Services')
{
    GetModal_Services($conn);
    return;
}
function GetModal_ServicesInfo($conn)
{
        global $lang;
	//foreach($_GET as $variable => $value) echo $variable . "&nbsp;=&nbsp;" . $value . "<br />\r\n";

    echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h5 class="modal-title" id="ajaxModalLabel">'.$lang['services_info'].'</h5>
        </div>
        <div class="modal-body" id="ajaxModalBody">';
    echo '<div class="list-group">';
    if(isset($_GET['Action'])) {
        if($_GET['Action']=='start' || $_GET['Action']=='stop' || $_GET['Action']=='enable' || $_GET['Action']=='disable') {
            if(substr($_GET['id'],0,10)=='homebridge') {
                if($_GET['Action']=='start' || $_GET['Action']=='stop') {
                        $rval=my_exec("sudo hb-service " . $_GET['Action']);
                } elseif ($_GET['Action']=='enable') {
                        $rval=my_exec("sudo hb-service install --user homebridge");
                } else {
                        $rval=my_exec("sudo hb-service uninstall");
                }
            } else {
                $rval=my_exec("/usr/bin/sudo /bin/systemctl " . $_GET['Action'] . " " . $_GET['id']);
            }
            $per='';
            similar_text($rval['stderr'],'We trust you have received the usual lecture from the local System Administrator. It usually boils down to these three things: #1) Respect the privacy of others. #2) Think before you type. #3) With great power comes great responsibility. sudo: no tty present and no askpass program specified',$per);
            if($per>80) {
		if(substr($_GET['id'],0,10)=='homebridge') {
                	$rval['stdout']='www-data cannot issue  hb-service commands.<br/><br/>If you would like it to be able to, add<br/><code>www-data ALL=/usr/bin/hb-service<br/>www-data ALL=NOPASSWD: /usr/bin/hb-service</code><br/>to /etc/sudoers.d/010_pi-nopasswd.';
		} else {
			$rval['stdout']='www-data cannot issue systemctl commands.<br/><br/>If you would like it to be able to, add<br/><code>www-data ALL=/bin/systemctl<br/>www-data ALL=NOPASSWD: /bin/systemctl</code><br/>to /etc/sudoers.d/010_pi-nopasswd.';
		}
                $rval['stderr']='';
            }
            echo '<p class="text-muted">systemctl ' . $_GET['Action'] . ' ' . $_GET['id'] . '<br/>stdout: ' . $rval['stdout'] . '<br/>stderr: ' . $rval['stderr'] . '</p>';
        }
    }

    $rval=my_exec("/bin/systemctl status " . $_GET['id']);
    echo '<span class="list-group-item">' . $_GET['id'] . '<br/>';
    echo '<span class="text-muted small">';
    if($rval['stdout']=='') {
        echo 'Error: ' . $rval['stderr'];
    } else {
        $stat='Status: Unknown';
        $rval['stdout']=explode(PHP_EOL,$rval['stdout']);
        foreach($rval['stdout'] as $line) {
            if(strstr($line,'Loaded:')) {
                if(strstr($line,'disabled;')) {
                    $stat='Status: Disabled';
                    break;
                }
            }
            if(strstr($line,'Active:')) {
                if(strstr($line,'active (running)')) {
                    $stat=trim($line);
                    break;
                } else if(strstr($line,'(dead)')) {
                    $stat='Status: Dead';
                    break;
                }
            }
        }
        echo $stat . '<br/>';
    }
    echo '</span>';
    echo '</span>';

    if(substr($_GET['id'],0,7)=='pihome.' or substr($_GET['id'],0,7)=='pihome_' or substr($_GET['id'],0,10)=='homebridge' or substr($_GET['id'],0,11)=='autohotspot' or substr($_GET['id'],0,14)=='HA_integration') {
        echo '<span class="list-group-item" style="height:40px;">&nbsp;';
        echo '<span class="pull-right text-muted small">
              <button class="btn btn-warning btn-xs" data-remote="false" data-target="#ajaxModal" data-ajax="ajax.php?Ajax=GetModal_ServicesInfo&id=' . $_GET['id'] . '&Action=start" onclick="services_Info(this);">
                Start</button>
              <button class="btn btn-warning btn-xs" data-remote="false" data-target="#ajaxModal" data-ajax="ajax.php?Ajax=GetModal_ServicesInfo&id=' . $_GET['id'] . '&Action=stop" onclick="services_Info(this);">
                Stop</button>
              <button class="btn btn-warning btn-xs" data-remote="false" data-target="#ajaxModal" data-ajax="ajax.php?Ajax=GetModal_ServicesInfo&id=' . $_GET['id'] . '&Action=enable" onclick="services_Info(this);">
                Enable</button>
              <button class="btn btn-warning btn-xs" data-remote="false" data-target="#ajaxModal" data-ajax="ajax.php?Ajax=GetModal_ServicesInfo&id=' . $_GET['id'] . '&Action=disable" onclick="services_Info(this);">
                Disable</button>
              </span>';
        echo '</span>';
    }

    $rval=my_exec("/bin/journalctl -u " . $_GET['id'] . " -n 10 --no-pager");
    $per='';
    similar_text($rval['stderr'],'Hint: You are currently not seeing messages from other users and the system. Users in the \'systemd-journal\' group can see all messages. Pass -q to turn off this notice. No journal files were opened due to insufficient permissions.',$per);
    if($per>80)
    {
        $rval['stdout']='www-data cannot access journalctl.<br/><br/>If you would like it to be able to, run<br/><code>sudo usermod -a -G systemd-journal www-data</code><br/>and then reboot the RPi.';
    }
    echo '<span class="list-group-item" style="overflow:hidden;">&nbsp;';
    echo 'Status: <i class="ion-ios-refresh-outline" data-remote="false" data-target="#ajaxModal" data-ajax="ajax.php?Ajax=GetModal_ServicesInfo&id=' . $_GET['id'] . '" onclick="services_Info(this);"></i><br/>';
    echo '<span class="text-muted small">';
    echo Convert_CRLF($rval['stdout'],'<br/>');
    echo '</span></span>';

    if($_GET['id']=='pihome_amazon_echo.service') {
        echo '<span class="list-group-item" style="overflow:hidden;">Install Service:';
        echo '<span class="pull-right text-muted small">Edit /lib/systemd/system/' . $_GET['id'] . '<br/>
<code>sudo nano /lib/systemd/system/' . $_GET['id'] . '</code><br/>
Put the following contents in the file:<br/>
(make sure the -u is supplied to python<br/>
to ensure the output is not buffered and delayed)<br/>
<code>[Unit]<br/>';
if($_GET['id']=='pihome_amazon_echo.service') {
        echo 'Description=Amazon Echo Service<br/>';
}
echo 'After=multi-user.target<br/>
<br/>
[Service]<br/>
Type=simple<br/>';
if($_GET['id']=='pihome_amazon_echo.service') {
        echo 'ExecStart=/usr/bin/python -u /var/www/add_on/amazon_echo/echo_pihome.py<br/>';
}
echo 'Restart=on-abort<br/>
<br/>
[Install]<br/>
WantedBy=multi-user.target</code><br/>
Update the file permissions:<br/>
<code>sudo chmod 644 /lib/systemd/system/' . $_GET['id'] . '</code><br/>
Update systemd:<br/>
<code>sudo systemctl daemon-reload</code><br/>
<br/>
For improved performance, lower SD card writes:<br/>
Edit /etc/systemd/journald.conf<br/>
<code>sudo nano /etc/systemd/journald.conf</code><br/>
Edit/Add the following:<br/>
<code>Storage=volatile<br/>
RuntimeMaxUse=50M</code><br/>
Then restart journald:<br/>
<code>sudo systemctl restart systemd-journald</code><br/>
Refer to: <a href="www.freedesktop.org/software/systemd/man/journald.conf.html">www.freedesktop.org/software/systemd/man/journald.conf.html</a><br/>
              </span>';
        echo '</span>';
    }

    echo '</div>';      //close class="list-group">';
    echo '</div>';      //close class="modal-body">
    echo '<div class="modal-footer" id="ajaxModalFooter">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">'.$lang['close'].'</button>
        </div>';      //close class="modal-footer">
    echo '<script language="javascript" type="text/javascript">
        services_Info=function(ithis){ $("#ajaxModal").one("hidden.bs.modal", function() { $("#ajaxModal").modal("show",$(ithis)); }).modal("hide");};
    </script>';
    return;
}
if($_GET['Ajax']=='GetModal_ServicesInfo')
{
    GetModal_ServicesInfo($conn);
    return;
}



function GetModal_Uptime($conn)
{
        global $lang;
	//foreach($_GET as $variable => $value) echo $variable . "&nbsp;=&nbsp;" . $value . "<br />\r\n";

    echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h5 class="modal-title" id="ajaxModalLabel">'.$lang['system_uptime'].'</h5>
        </div>
        <div class="modal-body" id="ajaxModalBody">
			<p class="text-muted"> '.$lang['system_uptime_text'].' </p>
			<i class="fa fa-clock-o fa-1x red"></i>';
    $uptime = (exec ("cat /proc/uptime"));
    $uptime=substr($uptime, 0, strrpos($uptime, ' '));
    echo secondsToWords($uptime) . '<br/><br/>';

    echo '<div class="list-group">';
    echo '<span class="list-group-item" style="overflow:hidden;"><pre>';
    $rval=my_exec("df -h");
    echo $rval['stdout'];
    echo '</pre></span>';

    echo '<span class="list-group-item" style="overflow:hidden;"><pre>';
    $rval=my_exec("free -h");
    echo $rval['stdout'];
    echo '</pre></span>';


/*    while ($row = mysqli_fetch_assoc($results)) {
        echo '<span class="list-group-item">';
        echo $row['name'] . ($row['enabled'] ? '' : ' (Disabled)');
        echo '<span class="pull-right text-muted small" style="width:200px;text-align:right;">Username:&nbsp;' . $row['username'] . '</span>';
        echo '<br/><span class="text-muted small">Type:&nbsp;';
        if($row['type']==0) echo 'Default, monitor.';
        else if($row['type']==1) echo 'Sonoff Tasmota.';
        else echo 'Unknown.';
        echo '</span>';
        echo '<span class="pull-right text-muted small" style="width:200px;text-align:right;">Password:&nbsp;' . $row['password'] . '</span>';
        echo '<br/><span class="text-muted small">' . $row['ip'] . '&nbsp;:&nbsp;' . $row['port'] . '</span>';

        echo '<span class="pull-right text-muted small" style="width:200px;text-align:right;">';
        echo '<button class="btn btn-default btn-xs" data-remote="false" data-target="#ajaxModal" data-ajax="ajax.php?Ajax=GetModal_MQTTEdit&id=' . $row['id'] . '" onclick="mqtt_AddEdit(this);">
            <span class="ionicons ion-edit"></span></button>&nbsp;&nbsp;
		<button class="btn btn-danger btn-xs" onclick="mqtt_delete(' . $row['id'] . ');"><span class="glyphicon glyphicon-trash"></span></button>';
        echo '</span>';
        echo '</span>';
    }*/
    echo '</div>';      //close class="list-group">';
    echo '</div>';      //close class="modal-body">
    echo '<div class="modal-footer" id="ajaxModalFooter">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">'.$lang['close'].'</button>
        </div>';      //close class="modal-footer">
    return;
}
if($_GET['Ajax']=='GetModal_Uptime')
{
    GetModal_Uptime($conn);
    return;
}

function GetModal_Sensor_Graph($conn)
{
        global $lang;
        //foreach($_GET as $variable => $value) echo $variable . "&nbsp;=&nbsp;" . $value . "<br />\r\n";

	//create array of colours for the graphs
	$query ="SELECT * FROM sensors ORDER BY id ASC;";
	$results = $conn->query($query);
	$counter = 0;
	$count = mysqli_num_rows($results) + 2; //extra space made for system temperature graph
	$sensor_color = array();
	while ($row = mysqli_fetch_assoc($results)) {
        	$graph_id = $row['sensor_id'].".".$row['sensor_child_id'];
        	$sensor_color[$graph_id] = graph_color($count, ++$counter);
	}

	$pieces = explode(',', $_GET['Ajax']);
        $sensor_id = $pieces[1];
	$query="SELECT * FROM sensors WHERE id = {$pieces[1]} LIMIT 1;";
        $result = $conn->query($query);
        $row = mysqli_fetch_assoc($result);
	$name = $row['name'];
	$nodes_id = $row['sensor_id'];
	$child_id = $row['sensor_child_id'];
	$type_id = $row['sensor_type_id'];
	if ($type_id == 1) { $title = $lang['temperature']; } else { $title = $lang['humidity']; }
        $title = $title.' '.$lang['graph'].' - '.$name;
        $graph_id = $row['sensor_id'].".".$row['sensor_child_id'];
	$query="SELECT node_id FROM nodes WHERE id = {$nodes_id} LIMIT 1;";
	$result = $conn->query($query);
	$row = mysqli_fetch_assoc($result);
	if ($pieces[2] == 0) {
        	$query="SELECT * from messages_in_view_24h  where node_id = '{$row['node_id']}' AND child_id = {$child_id} ORDER BY id ASC;";
                $ajax_modal = "ajax.php?Ajax=GetModal_Sensor_Graph,".$pieces[1].",1";
		$button_name = $lang['graph_1h'];
	} else {
                $query="SELECT * from messages_in_view_1h  where node_id = '{$row['node_id']}' AND child_id = {$child_id} ORDER BY id ASC;";
                $ajax_modal = "ajax.php?Ajax=GetModal_Sensor_Graph,".$pieces[1].",0";
                $button_name = $lang['graph_24h'];
	}
        $results = $conn->query($query);
        // create array of pairs of x and y values for every zone
        $data_x = array();
        $data_y = array();
        while ($rowb = mysqli_fetch_assoc($results)) {
		$data_x[] = strtotime($rowb['datetime']) * 1000;
		$data_y[] = $rowb['payload'];
        }
	$js_array_x = json_encode($data_x);
        $js_array_y = json_encode($data_y);
	?>
	<script type="text/javascript" src="js/plugins/plotly/plotly-2.9.0.min.js"></script>
        <script type="text/javascript" src="js/plugins/plotly/d3.min.js"></script>
	<script>

        var xValues = [<?php echo substr($js_array_x, 1, -1) ?>];
        var yValues = [<?php echo substr($js_array_y, 1, -1) ?>];

	var data = [
		{
  			type: 'scatter',
  			mode: "lines",
  			x: xValues,
  			y: yValues,
			hovertemplate: 'At: %{x}<extra></extra>' +
                        '<br><b>Temp: </b>: %{y:.2f}\xB0<br>',
			showlegend: false,
			line: {color: '<?php echo $sensor_color[$graph_id]; ?>'}
		}
	];

        var layout = {
                xaxis: {
                title: 'Time',
                type: 'date',
                tickmode: "linear",
                tick0: 0,
                dtick: 2*60*60*1000,
                tickformat: '%H:%M'
                },
                yaxis: {
                title: 'Temperature'
                },
                automargin: true,
        };

	var config = {
  		displayModeBar: true, // this is the line that hides the bar.
	};

	Plotly.newPlot('myChart', data, layout, config);
	</script>
<?php
        echo '<div class="modal-header">
            <h5 class="modal-title" id="ajaxModalLabel">'.$title.'</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        </div>
        <div class="modal-body" id="ajaxModalBody">
		<div id="myChart" style="width:100%;max-width:580px"></div>
    	</div>
    	<div class="modal-footer" id="ajaxModalFooter">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-remote="false" data-target="#ajaxModal" data-ajax="'.$ajax_modal.'"  onclick="sensors_Graph(this);">'.$button_name.'</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">'.$lang['close'].'</button>
        </div>';      //close class="modal-footer">
        echo '<script language="javascript" type="text/javascript">
                sensors_Graph=function(gthis){ $("#ajaxModal").one("hidden.bs.modal", function() { $("#ajaxModal").modal("show",$(gthis)); })};
        </script>';
    return;
}
if(explode(',', $_GET['Ajax'])[0]=='GetModal_Sensor_Graph')
{
    GetModal_Sensor_Graph($conn);
    return;
}

function GetModal_Sensors($conn)
{
	global $lang;
	//foreach($_GET as $variable => $value) echo $variable . "&nbsp;=&nbsp;" . $value . "<br />\r\n";

	echo '<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            	<h5 class="modal-title" id="ajaxModalLabel">'.$lang['temperature_sensor'].'</h5>
        </div>
        <div class="modal-body" id="ajaxModalBody">
                <p class="text-muted"> '.$lang['temperature_sensor_text'].' </p>';
		$query = "SELECT * FROM nodes where name LIKE '%Sensor' ORDER BY node_id asc;";
		$results = $conn->query($query);
		echo '<div class=\"list-group\">';
			while ($row = mysqli_fetch_assoc($results)) {
				$batquery = "select * from nodes_battery where node_id = {$row['node_id']} ORDER BY id desc limit 1;";
				$batresults = $conn->query($batquery);
				$brow = mysqli_fetch_array($batresults);
				//check if sensors in use by any zone
				$query = "SELECT * FROM zone_sensors where sensor_id = {$row['id']} Limit 1;";
				$zresult = $conn->query($query);
				$rcount = mysqli_num_rows($zresult);
				echo "<div class=\"list-group-item\"><i class=\"ionicons ion-thermometer red\"></i> ".$row['node_id'];
					if ($row['ms_version'] > 0){echo '- <i class="fa fa-battery-full"></i> '.round($brow ['bat_level'],0).'% - '.$brow ['bat_voltage'];}
        				echo '<span class="pull-right text-muted small"><button type="button"  data-remote="false" data-target="#ajaxModal" data-ajax="ajax.php?Ajax=GetModal_SensorsInfo&id=' . $row['node_id'] . '" onclick="sensors_Info(this);"><em>'.$row['last_seen'].'&nbsp</em></span></button>
				</div> ';
			}
    	echo '</div>';      //close class="modal-body">
    	echo '<div class="modal-footer" id="ajaxModalFooter">
		<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">'.$lang['close'].'</button>
        </div>';      //close class="modal-footer">
    	echo '<script language="javascript" type="text/javascript">
        	sensors_Info=function(ithis){ $("#ajaxModal").one("hidden.bs.modal", function() { $("#ajaxModal").modal("show",$(ithis)); }).modal("hide");};
    	</script>';
   	 return;
}
if($_GET['Ajax']=='GetModal_Sensors')
{
    	GetModal_Sensors($conn);
    	return;
}
function GetModal_SensorsInfo($conn)
{
        global $lang;
        $query = "SELECT COUNT(DISTINCT `child_id`) AS TotalRows FROM `messages_in` WHERE `node_id` = '{$_GET['id']}';";
        $result = $conn->query($query);
        $num_child = mysqli_fetch_assoc($result);
        $query = "SELECT * FROM messages_in_view_24h WHERE node_id = '{$_GET['id']}'";
        $results = $conn->query($query);
        $count = mysqli_num_rows($results);

        echo '<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h5 class="modal-title" id="ajaxModalLabel">'.$lang['sensor_last24h'].$_GET['id'].'&nbsp('.$num_child['TotalRows'].')</h5>
        </div>
        <div class="modal-body" id="ajaxModalBody">';
                echo '<p class="text-muted">'.$lang['node_count_last24h'].$count.'<br>';
                echo $lang['average_count_last24h'].intval((($count/$num_child['TotalRows'])/24)).'</p>';
                if ($count > 0) {
                	echo '<table class="table table-fixed">
                        	<thead>
                                	<tr>
                                        	<th class="col-xs-6"><small>'.$lang['sensor_name'].'</small></th>
                                        	<th style="text-align:center; vertical-align:middle;" class="col-xs-6"><small>'.$lang['last_seen'].'</small></th>
                                	</tr>
                        	</thead>
                        	<tbody>';
	                		while ($row = mysqli_fetch_assoc($results)) {
						$query = "SELECT id FROM nodes WHERE node_id = {$row['node_id']} LIMIT 1;";
						$result = $conn->query($query);
						$nodes_row = mysqli_fetch_assoc($result);
                                		$query = "SELECT name FROM sensors WHERE sensor_id = {$nodes_row['id']} AND sensor_child_id = {$row['child_id']} LIMIT 1;";
	                                	$s_result = $conn->query($query);
						$scount=mysqli_num_rows($s_result);
						if ($scount > 0) {
							$sensor_row = mysqli_fetch_assoc($s_result);
							$s_name = $sensor_row['name'];
						} else {
							$s_name = $lang['unallocated_sensor'].$row['child_id'];
						}
                        	        	echo '<tr>
                                	        	<td class="col-xs-6">'.$s_name.'</td>
                                        		<td style="text-align:center; vertical-align:middle;" class="col-xs-6">'.$row["datetime"].'</td>
                                		</tr>';
					}
			 	echo '</tbody>
			</table>';
		}
    	echo '</div>
    	<div class="modal-footer" id="ajaxModalFooter">
            	<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">'.$lang['close'].'</button>
        </div>';      //close class="modal-footer">
    	echo '<script language="javascript" type="text/javascript">
        	services_Info=function(ithis){ $("#ajaxModal").one("hidden.bs.modal", function() { $("#ajaxModal").modal("show",$(ithis)); }).modal("hide");};
    	</script>';
    	return;
}
if($_GET['Ajax']=='GetModal_SensorsInfo')
{
    	GetModal_SensorsInfo($conn);
    	return;
}

