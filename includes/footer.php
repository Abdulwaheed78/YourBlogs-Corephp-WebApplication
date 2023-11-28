<style>
  /* Global styles */
  #footer {
    background-color: #33383c !important;
    padding: 50px 0 30px !important;
    width: 100% !important;
  }

  #infoSection,
  #resourcesSection,
  #helpSection,
  #contactSection {
    margin-bottom: 30px;
    /* Add some bottom margin between sections */
  }

  .footer-heading {
    letter-spacing: 2px;
  }

  .footer-link a {
    color: #acacac;
    line-height: 40px;
    font-size: 14px;
    transition: all 0.5s;
  }

  .footer-link a:hover {
    color: #1bbc9b;
  }

  .contact-info {
    color: #acacac;
    font-size: 14px;
  }




  #footerAlt {
    color: #acacac;
  }

  #footerAlt .footer-heading {
    position: relative;
    padding-bottom: 12px;
  }

  #footerAlt .footer-heading:after {
    content: '';
    width: 25px;
    border-bottom: 1px solid #FFF;
    position: absolute;
    left: 0;
    bottom: 0;
    display: block;
    border-bottom: 1px solid #1bbc9b;
  }

  /* Media query for mobile */
  @media screen and (max-width: 767px) {

    #infoSection,
    #resourcesSection,
    #helpSection,
    #contactSection {
      text-align: center;
    }

    .footer-link,
    .contact-info,
    .footer-social-icon {
      text-align: center;
    }
  }

  /* Media query for tablets */
  @media screen and (min-width: 768px) and (max-width: 1023px) {

    #infoSection,
    #resourcesSection,
    #helpSection,
    #contactSection {
      width: 50%;
      float: left;
      text-align: left;
    }
  }
</style>



<footer id="footer" class="section bg-footer" width="100%">
  <div class="container">
    <div class="row">
      <div id="infoSection" class="col-lg-3">
        <div class="">
          <h6 id="infoHeading" class="footer-heading text-uppercase text-white">Information</h6>
          <ul class="list-unstyled footer-link mt-4">
            <li><a href="">Pages</a></li>
            <li><a href="">Our Team</a></li>
            <li><a href="">Features</a></li>
            <li><a href="">Pricing</a></li>
          </ul>
        </div>
      </div>

      <div id="resourcesSection" class="col-lg-3">
        <div class="">
          <h6 id="resourcesHeading" class="footer-heading text-uppercase text-white">Resources</h6>
          <ul class="list-unstyled footer-link mt-4">
            <li><a href="">Monitoring Grader</a></li>
            <li><a href="">Video Tutorial</a></li>
            <li><a href="">Term &amp; Service</a></li>
            <li><a href="">Zeeko API</a></li>
          </ul>
        </div>
      </div>

      <div id="helpSection" class="col-lg-2">
        <div class="">
          <h6 id="helpHeading" class="footer-heading text-uppercase text-white">Help</h6>
          <ul class="list-unstyled footer-link mt-4">
            <li><a href="">Sign Up </a></li>
            <li><a href="">Login</a></li>
            <li><a href="">Terms of Services</a></li>
            <li><a href="">Privacy Policy</a></li>
          </ul>
        </div>
      </div>

      <div id="contactSection" class="col-lg-4">
        <div class="">
          <h6 id="contactHeading" class="footer-heading text-uppercase text-white">Contact Us</h6>
          <p class="contact-info mt-4">Contact us if you need help with anything</p>
          <p class="contact-info">+01 123-456-7890</p>
          <div class="mt-5">
            <ul class="list-inline">
              <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-facebook" viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                  </svg></a></li>
              <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-instagram" viewBox="0 0 16 16">
                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                  </svg></a></li>
              <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-linkedin" viewBox="0 0 16 16">
                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401m-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4" />
                  </svg></a></li>
              <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-twitter" viewBox="0 0 16 16">
                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15" />
                  </svg></i></a></li>
              <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-google" viewBox="0 0 16 16">
                    <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                  </svg></i></a></li>
              <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-apple" viewBox="0 0 16 16">
                    <path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516.024.034 1.52.087 2.475-1.258.955-1.345.762-2.391.728-2.43Zm3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422.212-2.189 1.675-2.789 1.698-2.854.023-.065-.597-.79-1.254-1.157a3.692 3.692 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56.244.729.625 1.924 1.273 2.796.576.984 1.34 1.667 1.659 1.899.319.232 1.219.386 1.843.067.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758.347-.79.505-1.217.473-1.282Z" />
                    <path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516.024.034 1.52.087 2.475-1.258.955-1.345.762-2.391.728-2.43Zm3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422.212-2.189 1.675-2.789 1.698-2.854.023-.065-.597-.79-1.254-1.157a3.692 3.692 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56.244.729.625 1.924 1.273 2.796.576.984 1.34 1.667 1.659 1.899.319.232 1.219.386 1.843.067.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758.347-.79.505-1.217.473-1.282Z" />
                  </svg></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="footerAlt" class="text-center mt-5">
    <p class="footer-alt mb-0 f-14">2019 © Anup, All Rights Reserved</p>
  </div>
</footer>