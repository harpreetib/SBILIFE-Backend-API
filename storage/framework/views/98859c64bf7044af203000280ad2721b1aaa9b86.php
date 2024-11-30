<?php $__env->startSection('page-css'); ?>
     <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/pickadate/classic.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/pickadate/classic.date.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
    <link href="https://ga-dev-tools.appspot.com/public/css/index.css" rel="stylesheet">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>

   <div class="breadcrumb">
                <h1>&nbsp;</h1>
                <ul>
                    <li><strong>Campaign URL Builder</strong></li>
                    <?php if(Session::get('AllEvent')==false): ?>
                     <li><?php echo e((isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '')); ?></li>
                    <?php else: ?>
                    <li>All Locations</li>
                    <?php endif; ?>
                    
                </ul>
            </div>
<div class="separator-breadcrumb border-top"></div>


            <div class="row">
                
                
                <div class="col-lg-12 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                                <div class="card-title">Campaign URL Builder</div>
                                    <div class="panel-body" align="center">
                                               
                                           <section>

<p>This tool allows you to easily add campaign parameters to URLs so you can track Custom Campaigns in Google Analytics.</p>

<h3 class="H3--underline">Enter the website URL and campaign information</h3>

<p>Fill out the required fields (marked with *) in the form below, and once complete the full campaign URL will be generated for you. <em>Note: the generated URL is automatically updated as you make changes.</em></p>

        <div id="campaign-url-builder">
   <div>
      <form class="CampaignUrlForm">
         <div class="FormControl FormControl--inline FormControl--required">
            <label class="FormControl-label">Website URL</label>
            <div class="FormControl-body">
               <textarea rows="3" class="FormField" id="weburl" placeholder=" " style="height: 34px;"></textarea>
               <div class="FormControl-info">The full website URL (e.g. <code>https://www.example.com</code>)</div>
            </div>
         </div>
         <div class="FormControl FormControl--inline FormControl--required">
            <label class="FormControl-label">Campaign Source</label>
            <div class="FormControl-body">
               <input class="FormField" name="utm_source" id="utm_source" placeholder=" " value="">
               <div class="FormControl-info">The referrer: (e.g.&nbsp;<code>google</code>,&nbsp;<code>newsletter</code>)</div>
            </div>
         </div>
         <div class="FormControl FormControl--inline FormControl--required">
            <label class="FormControl-label">Campaign Medium</label>
            <div class="FormControl-body">
               <input class="FormField" name="utm_medium"  id="utm_medium" placeholder=" " value="">
               <div class="FormControl-info">Marketing medium: (e.g.&nbsp;<code>cpc</code>,&nbsp;<code>banner</code>,&nbsp;<code>email</code>)</div>
            </div>
         </div>
         <div class="FormControl FormControl--inline FormControl--required">
            <label class="FormControl-label">Campaign Name</label>
            <div class="FormControl-body">
               <input class="FormField" name="utm_campaign" id="utm_campaign" placeholder=" " value="">
               <div class="FormControl-info">Product, promo code, or slogan (e.g. <code>spring_sale</code>)</div>
            </div>
         </div>
         <div class="FormControl FormControl--inline">
            <label class="FormControl-label">Campaign Term</label>
            <div class="FormControl-body">
               <input class="FormField" name="utm_term" id="utm_term" placeholder=" " value="">
               <div class="FormControl-info">Identify the paid keywords</div>
            </div>
         </div>
         <div class="FormControl FormControl--inline">
            <label class="FormControl-label">Campaign Content</label>
            <div class="FormControl-body">
               <input class="FormField" name="utm_content" id="utm_content" placeholder=" " value="">
               <div class="FormControl-info">Use to differentiate ads</div>
            </div>
         </div>
      </form>
      <div class="CampaignUrlResult">
         <h3 class="CampaignUrlResult-title">Share the generated campaign URL</h3>
         <div>
            <p>Use this URL in any promotional channels you want to be associated with this custom campaign</p>
            <div class="CampaignUrlResult-item">
               <div class="FormControl FormControl--full">
                  <div class="FormControl-body"><textarea rows="2" class="FormField" readonly="" id="generatedurl" style="height: 54px;"></textarea></div>
               </div>
               <div class="CampaignUrlResult-item">
                  <div class="ButtonSet">
                     <button class="Button" onclick="myfunctioncopy();">
                        <span class="Button-iconWrapper">
                           <span class="Button-icon">
                              <svg class="Icon" viewBox="0 0 24 24">
                                 <use xlink:href="https://ga-dev-tools.appspot.com/public/images/icons.svg#icon-content-paste"></use>
                              </svg>
                           </span>
                           Copy URL
                        </span>
                     </button>
                     
                  </div>
               </div>
               <div class="u-visuallyHidden"></div>
            </div>
         </div>
      </div>
   </div>
</div>

<h2>More information and examples for each parameter</h2>

<p>The following table gives a detailed explanation and example of each of the campaign parameters.</p>

<table class="Table">
  <tbody>
    <tr>
      <td>
        <p><strong>Campaign Source</strong></p>
        <p><code>utm_source</code></p>
      </td>
      <td>
        <p><strong>Required.</strong></p>
        <p>Use <code>utm_source</code> to identify a search engine, newsletter name, or other source.</p>
        <p><em>Example:</em> <code>google</code></p>
      </td>
    </tr>
    <tr>
      <td>
        <p><strong>Campaign Medium</strong></p>
        <p><code>utm_medium</code></p>
      </td>
      <td>
        <p><strong>Required.</strong></p>
        <p>Use <code>utm_medium</code> to identify a medium such as email or cost-per- click.</p>
        <p><em>Example:</em> <code>cpc</code></p>
      </td>
    </tr>
    <tr>
      <td>
        <p><strong>Campaign Name</strong></p>
        <p><code>utm_campaign</code></p>
      </td>
      <td>
        <p><strong>Required.</strong></p>
        <p>Used for keyword analysis. Use <code>utm_campaign</code> to identify a specific product promotion or strategic campaign.</p>
        <p><em>Example:</em> <code>utm_campaign=spring_sale</code></p>
      </td>
    </tr>
    <tr>
      <td>
        <p><strong>Campaign Term</strong></p>
        <p><code>utm_term</code></p>
      </td>
      <td>
        <p>Used for paid search. Use <code>utm_term</code> to note the keywords for this ad.</p>
        <p><em>Example:</em> <code>running+shoes</code></p>
      </td>
    </tr>
    <tr>
      <td>
        <p><strong>Campaign Content</strong></p>
        <p><code>utm_content</code></p>
      </td>
      <td>
        <p>Used for A/B testing and content-targeted ads. Use <code>utm_content</code> to differentiate ads or links that point to the same URL.</p>
        <p><em>Examples:</em> <code>logolink</code> <em>or</em> <code>textlink</code></p>
      </td>
    </tr>
  </tbody>
</table>




</section>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
  
  
  <script>
      
     $("input"). keyup(function(){ 
        $('#generatedurl').val('');
        var weburl=$('#weburl').val();
        var utm_source=$('#utm_source').val();
        var utm_medium=$('#utm_medium').val();
        var utm_campaign=$('#utm_campaign').val();
        var utm_term=$('#utm_term').val();
        var utm_content=$('#utm_content').val();
        var generatedurl='';
        if($.trim(weburl)!=''){
         
            generatedurl=weburl+"?utm_source="+utm_source+"&utm_medium="+utm_medium+"&utm_campaign="+utm_campaign+"&utm_term="+utm_term+"&utm_content="+utm_content;
            
            $('#generatedurl').val(encodeURI(generatedurl));
            
        }
            
        }); 
        
        function myfunctioncopy() {
  /* Get the text field */
  var copyText = document.getElementById("generatedurl");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  //alert("Copied the text: " + copyText.value);
}
      
  </script>
  
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/metagraha/public_html/induction/admin/resources/views/url-builder/campaign-manager.blade.php ENDPATH**/ ?>