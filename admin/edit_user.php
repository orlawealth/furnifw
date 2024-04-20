<?php 
	include "../core/init.php";
$error = "";
$email_err = "";
$password_err = "";
$country_err ="";
$reg ="";

if (isset($_POST['submit'])) {
	$user['full_name'] = $_POST['full_name'];
	$user['email'] = $_POST['email'];
	$user['phone_number'] = $_POST['phone_number'];
	$user['gender'] = $_POST['gender'];
	$user['country'] = $_POST['country'];

	$id = $_GET['id'] ?? '1';
		$user_id = (int)$id;

	$required_fields = array("full_name", "email", "phone_number", "gender", "country");
	foreach ($_POST as $key => $value) {
		if (empty($value) and in_array($key, $required_fields)){
			$error = '*Fill all fields';
		}
	}
	if (empty($error)) {//if so far there is no error (the user entered all details)
		if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
			$email_err = '*Please enter a valid email';
		} elseif (email_exists_update($user['email'], $user_id )) {
			$email_err = '*This email is already in use';
		}
		if($user['country']== "Select your country"){
			$country_err = "*Select your country";
		} 

		if (empty($email_err) && empty($country_err)) {
			$user_details = array(
					'full_name' => $user['full_name'],
					'email' => $user['email'],
					'phone_number' => $user['phone_number'],
					'gender' =>$user['gender'],
					'country' => $user['country']
			);

			if (update_user($user['full_name'], $user['email'], $user['phone_number'], $user['gender'], $user['country'], $user_id)) {
					$success = true;
				}else {
					echo "failed";
					die();
			}
		}

	}

}

$id = $_GET['id'] ?? '1';
		$user_id = (int)$id;
		if (find_user_by_id($user_id)) {
			$user = find_user_by_id($user_id);
		}else{
			header("Location:users.php");
}

$countries = array("SYC" => "Select your country",
"AF" => "Afghanistan",
"AX" => "Åland Islands",
"AL" => "Albania",
"DZ" => "Algeria",
"AS" => "American Samoa",
"AD" => "Andorra",
"AO" => "Angola",
"AI" => "Anguilla",
"AQ" => "Antarctica",
"AG" => "Antigua and Barbuda",
"AR" => "Argentina",
"AM" => "Armenia",
"AW" => "Aruba",
"AU" => "Australia",
"AT" => "Austria",
"AZ" => "Azerbaijan",
"BS" => "Bahamas",
"BH" => "Bahrain",
"BD" => "Bangladesh",
"BB" => "Barbados",
"BY" => "Belarus",
"BE" => "Belgium",
"BZ" => "Belize",
"BJ" => "Benin",
"BM" => "Bermuda",
"BT" => "Bhutan",
"BO" => "Bolivia",
"BA" => "Bosnia and Herzegovina",
"BW" => "Botswana",
"BV" => "Bouvet Island",
"BR" => "Brazil",
"IO" => "British Indian Ocean Territory",
"BN" => "Brunei Darussalam",
"BG" => "Bulgaria",
"BF" => "Burkina Faso",
"BI" => "Burundi",
"KH" => "Cambodia",
"CM" => "Cameroon",
"CA" => "Canada",
"CV" => "Cape Verde",
"KY" => "Cayman Islands",
"CF" => "Central African Republic",
"TD" => "Chad",
"CL" => "Chile",
"CN" => "China",
"CX" => "Christmas Island",
"CC" => "Cocos (Keeling) Islands",
"CO" => "Colombia",
"KM" => "Comoros",
"CG" => "Congo",
"CD" => "Congo, The Democratic Republic of The",
"CK" => "Cook Islands",
"CR" => "Costa Rica",
"CI" => "Cote D'ivoire",
"HR" => "Croatia",
"CU" => "Cuba",
"CY" => "Cyprus",
"CZ" => "Czech Republic",
"DK" => "Denmark",
"DJ" => "Djibouti",
"DM" => "Dominica",
"DO" => "Dominican Republic",
"EC" => "Ecuador",
"EG" => "Egypt",
"SV" => "El Salvador",
"GQ" => "Equatorial Guinea",
"ER" => "Eritrea",
"EE" => "Estonia",
"ET" => "Ethiopia",
"FK" => "Falkland Islands (Malvinas)",
"FO" => "Faroe Islands",
"FJ" => "Fiji",
"FI" => "Finland",
"FR" => "France",
"GF" => "French Guiana",
"PF" => "French Polynesia",
"TF" => "French Southern Territories",
"GA" => "Gabon",
"GM" => "Gambia",
"GE" => "Georgia",
"DE" => "Germany",
"GH" => "Ghana",
"GI" => "Gibraltar",
"GR" => "Greece",
"GL" => "Greenland",
"GD" => "Grenada",
"GP" => "Guadeloupe",
"GU" => "Guam",
"GT" => "Guatemala",
"GG" => "Guernsey",
"GN" => "Guinea",
"GW" => "Guinea-bissau",
"GY" => "Guyana",
"HT" => "Haiti",
"HM" => "Heard Island and Mcdonald Islands",
"VA" => "Holy See (Vatican City State)",
"HN" => "Honduras",
"HK" => "Hong Kong",
"HU" => "Hungary",
"IS" => "Iceland",
"IN" => "India",
"ID" => "Indonesia",
"IR" => "Iran, Islamic Republic of",
"IQ" => "Iraq",
"IE" => "Ireland",
"IM" => "Isle of Man",
"IL" => "Israel",
"IT" => "Italy",
"JM" => "Jamaica",
"JP" => "Japan",
"JE" => "Jersey",
"JO" => "Jordan",
"KZ" => "Kazakhstan",
"KE" => "Kenya",
"KI" => "Kiribati",
"KP" => "Korea, Democratic People's Republic of",
"KR" => "Korea, Republic of",
"KW" => "Kuwait",
"KG" => "Kyrgyzstan",
"LA" => "Lao People's Democratic Republic",
"LV" => "Latvia",
"LB" => "Lebanon",
"LS" => "Lesotho",
"LR" => "Liberia",
"LY" => "Libyan Arab Jamahiriya",
"LI" => "Liechtenstein",
"LT" => "Lithuania",
"LU" => "Luxembourg",
"MO" => "Macao",
"MK" => "Macedonia, The Former Yugoslav Republic of",
"MG" => "Madagascar",
"MW" => "Malawi",
"MY" => "Malaysia",
"MV" => "Maldives",
"ML" => "Mali",
"MT" => "Malta",
"MH" => "Marshall Islands",
"MQ" => "Martinique",
"MR" => "Mauritania",
"MU" => "Mauritius",
"YT" => "Mayotte",
"MX" => "Mexico",
"FM" => "Micronesia, Federated States of",
"MD" => "Moldova, Republic of",
"MC" => "Monaco",
"MN" => "Mongolia",
"ME" => "Montenegro",
"MS" => "Montserrat",
"MA" => "Morocco",
"MZ" => "Mozambique",
"MM" => "Myanmar",
"NA" => "Namibia",
"NR" => "Nauru",
"NP" => "Nepal",
"NL" => "Netherlands",
"AN" => "Netherlands Antilles",
"NC" => "New Caledonia",
"NZ" => "New Zealand",
"NI" => "Nicaragua",
"NE" => "Niger",
"NG" => "Nigeria",
"NU" => "Niue",
"NF" => "Norfolk Island",
"MP" => "Northern Mariana Islands",
"NO" => "Norway",
"OM" => "Oman",
"PK" => "Pakistan",
"PW" => "Palau",
"PS" => "Palestinian Territory, Occupied",
"PA" => "Panama",
"PG" => "Papua New Guinea",
"PY" => "Paraguay",
"PE" => "Peru",
"PH" => "Philippines",
"PN" => "Pitcairn",
"PL" => "Poland",
"PT" => "Portugal",
"PR" => "Puerto Rico",
"QA" => "Qatar",
"RE" => "Reunion",
"RO" => "Romania",
"RU" => "Russian Federation",
"RW" => "Rwanda",
"SH" => "Saint Helena",
"KN" => "Saint Kitts and Nevis",
"LC" => "Saint Lucia",
"PM" => "Saint Pierre and Miquelon",
"VC" => "Saint Vincent and The Grenadines",
"WS" => "Samoa",
"SM" => "San Marino",
"ST" => "Sao Tome and Principe",
"SA" => "Saudi Arabia",
"SN" => "Senegal",
"RS" => "Serbia",
"SC" => "Seychelles",
"SL" => "Sierra Leone",
"SG" => "Singapore",
"SK" => "Slovakia",
"SI" => "Slovenia",
"SB" => "Solomon Islands",
"SO" => "Somalia",
"ZA" => "South Africa",
"GS" => "South Georgia and The South Sandwich Islands",
"ES" => "Spain",
"LK" => "Sri Lanka",
"SD" => "Sudan",
"SR" => "Suriname",
"SJ" => "Svalbard and Jan Mayen",
"SZ" => "Swaziland",
"SE" => "Sweden",
"CH" => "Switzerland",
"SY" => "Syrian Arab Republic",
"TW" => "Taiwan, Province of China",
"TJ" => "Tajikistan",
"TZ" => "Tanzania, United Republic of",
"TH" => "Thailand",
"TL" => "Timor-leste",
"TG" => "Togo",
"TK" => "Tokelau",
"TO" => "Tonga",
"TT" => "Trinidad and Tobago",
"TN" => "Tunisia",
"TR" => "Turkey",
"TM" => "Turkmenistan",
"TC" => "Turks and Caicos Islands",
"TV" => "Tuvalu",
"UG" => "Uganda",
"UA" => "Ukraine",
"AE" => "United Arab Emirates",
"GB" => "United Kingdom",
"US" => "United States",
"UM" => "United States Minor Outlying Islands",
"UY" => "Uruguay",
"UZ" => "Uzbekistan",
"VU" => "Vanuatu",
"VE" => "Venezuela",
"VN" => "Viet Nam",
"VG" => "Virgin Islands, British",
"VI" => "Virgin Islands, U.S.",
"WF" => "Wallis and Futuna",
"EH" => "Western Sahara",
"YE" => "Yemen",
"ZM" => "Zambia",
"ZW" => "Zimbabwe");


include "admin_header.php";
?>
<div class="container">
		<div class="row">
			<div class="offset-2 col-lg-8 bg-primary text-white mt-4 shadow pl-5 pr-5 pb-5 pt-3 mb-5 rounded">

				<p class = "update_message">	
					<?php 	 
						if (isset($user_details)){  
							if($success === true) {
								echo '
										You have succesfully updated user\'s information!
									';
									die();
							}else{

								echo '
									<span class = "error_message">
										Something went wrong. Please try again. If problem persists, contact the site admin in the contact us page
									</span>';

							}	
						}
					?>
				</p>
				<h2 class="offset-4">Edit user info!</h2>
				<div><p class="err "><?php echo $error; ?></p></div>

				<form method="post" action="">
					<fieldset class="form-group">
						<div class="form-group row">
							<div class="col-sm-6 mb-3 mb-sm-0">
								<input class="form-control " type="email" name="email" value="<?php echo $user['email']; ?>" placeholder="Email">
							<span class="err"><?php echo $email_err ?></span>
							</div>
							<div class="col-sm-6 mb-3 mb-sm-0">
								<input class="form-control" type="text" name="full_name" value="<?php echo $user['full_name']; ?>" placeholder="Full Name">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6 mb-3 mb-sm-0">
								<input class="form-control" type="number" name="phone_number" value="<?php echo $user['phone_number']; ?>" placeholder="Phone Number">
							</div>
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label>Gender</label><br>
								Male <input class="form" type="radio" name="gender" value="male" checked  <?php if($user['gender'] == "male"){echo "checked";} ?>>
								Female <input class="" type="radio" name="gender" value="female"  <?php if($user['gender'] == "female"){echo "checked";} ?>>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6 mb-3 mb-sm-0">

								<select class="form-control" name="country" id="country">
									<?php
									echo '<option>'.$user['country'].'</option>';
									foreach($countries as $key => $value) {

									?>  
									<option value="<?= $value ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
									<?php

									}

									?>
								</select>
								<span class="err"><?php echo $country_err ?></span> 

							</div>
						</div>
					</fieldset>
					<input type="submit" name="submit" class=" offset-sm-5 btn btn-outline-light rounded-pill" value="Update user info"></input>
				</form>
			</div>
		</div>
	</div>
<?php
include "admin_footer.php";
?>
