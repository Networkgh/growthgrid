<?php include 'includes/affregveri.php'?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Registration - Growth Grid 26</title>
    <link rel="stylesheet" href="style.css">
    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.affiliate-container {
    max-width: 600px;
    margin: 50px auto;
    background-color: #ffffff;
    padding: 30px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin-top: 200px;
}

.affiliate-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #003554;
}

.affiliate-container label {
    display: block;
    margin-bottom: 5px;
    color: #333333;
}

.affiliate-container input[type="text"],
.affiliate-container input[type="email"],
.affiliate-container input[type="tel"],
.affiliate-container input[type="url"],
.affiliate-container select,
.affiliate-container textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.affiliate-container textarea {
    resize: vertical;
}

.affiliate-container button {
    width: 100%;
    padding: 15px;
    background-color: #003554;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.affiliate-container button:hover {
    background-color: #00263b;
}

.affiliate-container a {
    color: #003554;
    text-decoration: none;
}

.affiliate-container a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .affiliate-container {
        max-width: 300px;
        margin: 50px auto;
        margin-top: 200px;
        align-items: center;
        padding-left: 90px;
        
    }

    .affiliate-container h2 {
        font-size: 24px;
    }
}

/*sucess {
	width: 92%; 
	margin: 0px auto; 
	padding: 10px; 
	color: green; 
	border-radius: 5px; 
	text-align: left;
}*/


    </style>
</head>
<body>
    <div class="affiliate-container">
        <h2>Affiliate Registration</h2>
        
        <p>Do You Have Your Own Product? <a href="vender_reg.php">Click Here</a></p>
        <form method="post" action="accountsettings.php">
            <!-- Personal Information -->
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
 
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required>
            <!-- Website/Business Information -->
            <label for="website">Website URL</label>
            <input type="url" id="website" name="website" placeholder="http://yourwebsite.com">

            <label for="company_name">Company Name (Optional)</label>
            <input type="text" id="company_name" name="company_name">

            <!-- Country Selection -->
            <label for="country">Country</label>
            <select id="country" name="country" required>
                <option value="">Select your country</option>
                <option value="Ghana">Ghana</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Kenya">Kenya</option>
                <option value="Niger">Niger</option>
                <option value="Mali">Mali</option> 
                <option value="South Africa">South Africa</option>
                <option value="Benin">Benin</option>
                <option value="Uganda">Uganda</option>
                <option value="Zambia">Zambia</option>
                <option value="Malawi">Malawi</option>
                <option value="Togo">Togo</option>
                <option value="Ivory Coast">Ivory Coast</option>
                <option value="Other">Other</option>
            </select>


            <!-- Payment Information -->
            <label for="payment_method">Preferred Payment Method</label>
            <select id="payment_method" name="payment_method" required>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="crypto">Cryptocurrency</option>
            </select>

            <label for="payment_details">Payment Details (e.g., PayPal Email, Bank Account, Crypto Wallet)</label>
            <textarea id="payment_details" name="payment_details" rows="3" required></textarea>

            <!-- Promotional Details -->
            <label for="how_hear">How Did You Hear About Us?</label>
            <select id="how_hear" name="how_hear">
                <option value="social_media">Social Media</option>
                <option value="search_engine">Search Engine</option>
                <option value="referral">Referral</option>
                <option value="other">Other</option>
            </select>

            <label for="promotional_methods">How Will You Promote Us?</label>
            <textarea id="promotional_methods" name="promotional_methods" rows="3" placeholder="Describe your promotional methods (e.g., blog, social media, etc.)" required></textarea>

            <!-- Terms and Conditions -->
            <label for="terms">
                <input type="checkbox" id="terms" name="terms" required> I agree to the <a href="terms.php">Terms and Conditions</a>
            </label>

            <!-- Submit Button -->
            <button type="submit" name="aff_reg">Register as an Affiliate</button>
        </form>
    </div>
</body>
</html>
