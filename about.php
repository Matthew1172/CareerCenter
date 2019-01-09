<?php
session_start();
require 'header.php';
include 'php/connect.php';
echo("<link href='styles/about.css' rel='stylesheet'>");
echo("<link href='styles/carousel.css' rel='stylesheet'/>");
echo("
<script>
$(document).ready(function(){});
</script>
");
echo('

<div class="grid">

<div class="hero1">
</div>

<div class="hero2">
</div>

<div class="hero3">
</div>

<div class="hero4">
</div>

<div class="hero5">
</div>

<div class="intro hero-head py-5">
<h1 class="hero-head">About the Rockland County Career Center.</h1>
</div>

<div class="intro-section">
<p>The Rockland County Career Center supports the adult, dislocated, and youth population in Rockland County in their transition to obtaining employment by providing job search assistance, innovative training programs, workshops and other services. All services are free of charge!<br/><br/>Representatives of the New York Department of Labor provide services at the Rockland County Career Center in our Haverstraw location.</p>
</div>

<div class="customers hero-head py-5">
<h1 class="hero-head">Customers.</h1>
</div>

<div class="customers-section">
<h4>Career staff will help you:</h4>
<ul>
<li>Develop a job search plan that meets you career objectives.</li>
<li>Conduct your job search with current information and employment resources.</li>
<li>Sharpen your critical job search skills.</li>
<li>Build a personal toolbox including cover letter and resume.</li>
<li>Fine-tune interview skills.</li>
</ul>

<h4 class="pt-5">Additional services include:</h4>
<ul>
<li>Basic computer training.</li>
<li>Career-related instructor-led workshops*.</li>
<li>Training funds for skills upgrade or career transition for qualified candidates*.</li>
<li>Computers with Internet access.</li>
<li>Fax, phone, copier.</li>
</ul>
<p class="text-muted pt-5">*<i>Requires training</i></p>
</div>

<div class="service py-5">
<h1 class="hero-head">Priority of service.</h1>
</div>

<div class="service-section">
<ol>
<li>
<p>Customer’s will be served in the following order of priority according to their county/state of residence and state of unemployment insurance collection:</p>
    <ol>
        <li>Rockland County residents collecting.</li>
        <li>NY state residents collecting in NY</li>
        <li>NY state residents collecting in CT/NJ</li>
        <li>NJ state residents collecting in NY</li>
        <li>NJ state residents collecting in NJ</li>
    </ol>
</li>
<li class="pt-5">
<p>Customers will be served in the following order of priority according to their level of education: </p>
    <ol>
        <li>Customer without a high school diploma</li>
        <li>Customer with a high school diploma</li>
        <li>Customer with an associate’s degree</li>
        <li>Customer with a bachelor’s degree</li>
        <li>Customer with a master’s degree</li>
        <li>Customer with a doctoral degree</li>
    </ol>
</li>
</ol>
<p class="text-muted pt-5">*<i>First order of priority will be given to veterans and/or low-income adults, adults, and then Dislocated Workers as deemed by WIOA.</i></p>
<p class="text-muted">*<i>Determinations for funding will be assessed on an Individual basis following the Priority of Service listed above. Submission of all documentation does not guarantee approval of training.</i></p>
</div>

<div class="employers hero-head py-5">
<h1 class="hero-head">Employers.</h1>
</div>

<div class="employers-section">
<h4>Career staff will help you:</h4>
<ul>
<li>Save time and money on staffing, training, and retraining employees</li>
<li>Speed your recruitment and selection process</li>
<li>Fill vacant positions with qualified job seekers</li>
<li>Identify trends and demand occupations to ensure you maintain a skilled workforce</li>
<li>Utilize the Career Center’s job listing system</li>
</ul>
</div>

<div class="youth hero-head py-5">
<h1 class="hero-head">Youth.</h1>
</div>

<div class="youth-section">
<p>Youth Services are provided by Rockland BOCES. If you have a out-of-school or in-school youth between the ages of  16-24. Please contact Rockland BOCES at 845-348-3500.<br/><br/>The Workforce Development Board of Rockland County receives funding through the Workforce Innovation Opportunity Act and oversees the Rockland County Career Center. The Career Center is operated by Rockland Community College through a contract with the Workforce Development Board.</p>
</div>

</div>
');
require 'footer.php';
?>
