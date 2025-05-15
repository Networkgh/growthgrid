<!-- Popup Form -->
<div class="overlay" id="overlay"></div>
<div class="popup-form" id="popup-form">
    <button class="close-btn" onclick="closeForm()">Close</button>
    <h2>Add New Product</h2>
    
    <!-- Requirements Section -->
    <div id="requirements" style="background-color: #f9f9f9; padding: 1rem; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 1rem;">
        <h3 style="color: #333;">Important Product Requirements</h3>
        <ul style="list-style: disc; margin-left: 1.5rem; color: #555; font-size: 0.9rem;">
            <li>Your product must have a professionally designed sales page with excellent sales copy.</li>
            <li>Provide valuable educational video content that is original and created by you.</li>
            <li>Video content should be in HD (1920x1080) with a 16:9 aspect ratio, clear audio, and no background noise.</li>
            <li>The course must be pre-recorded and hosted on an LMS or webpage (not live).</li>
            <li>At least 30 minutes of video content with a minimum of 5 lessons.</li>
            <li>Provide JV promotional materials for affiliates (e.g., banners, email swipes).</li>
            <li>Include a sales page, thank-you page, and JV page for your product.</li>
            <li>Ensure your promotional materials comply with ethical marketing guidelines.</li>
        </ul>
    </div>

    <!-- Product Form -->
    <form action="my-products.php" method="POST" enctype="multipart/form-data">
        <label for="product_image">Product Image:</label>
        <input type="file" id="product_image" name="product_image" accept="image/*" required onchange="previewImage(event)">

        <!-- Image Preview Container -->
        <div id="image-preview" style="text-align: center; margin-bottom: 1rem;">
            <img id="preview" src="" alt="Image Preview" style="max-width: 100%; display: none;" />
        </div>

        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" rows="4" required></textarea>

        <label for="product_category">Product Category:</label>
        <select id="product_category" name="product_category" required>
            <option value="tech">Tech</option>
            <option value="ecommerce">Ecommerce</option>
            <option value="internet_marketing">Internet Marketing</option>
            <option value="affiliate_marketing">Affiliate Marketing</option>
            <option value="personal_development">Personal Development</option>
            <option value="software">Software</option>
            <option value="education">Education</option>
            <option value="training">Training</option>
            <option value="employment">Employment</option>
            <option value="sales_marketing">Sales Marketing</option>
            <option value="religious">Religious & Spirituality</option>
            <option value="health">Health</option>
            <option value="parenting">Parenting</option>
            <option value="arts_entertainment">Arts & Entertainment</option>
            <option value="business_finance">Business & Finance</option>
            <option value="household">Household</option>
            <option value="travel">Travel</option>
        </select>

        <label for="product_type">Product Type:</label>
        <select id="product_type" name="product_type" required>
            <option value="">Select Product Type</option>
            <option value="digital">Digital</option>
            <option value="services">Services</option>
            <option value="physical">Physical</option>
        </select>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="commission">Commission for Affiliate (%):</label>
        <input type="number" id="commission" name="commission" step="0.01" required>

        <label for="currency">Currency:</label>
        <select id="currency" name="currency" required>
            <option value="USD">USD - US Dollar</option>
        </select>

        <label for="sale_page">Sales Page URL:</label>
        <input type="url" id="sale_page" name="sale_page" required>

        <label for="resource_page">Product Resource Page:</label>
        <input type="url" id="resource_page" name="resource_page" required>

        <label for="thank_you_page">Thank You Page URL:</label>
        <input type="url" id="thank_you_page" name="thank_you_page" required>

        <button type="submit">Add Product</button>
    </form>
</div>
