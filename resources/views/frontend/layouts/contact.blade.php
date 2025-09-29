<section id="lienhe" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Liên hệ</h2>
        <p>Hãy liên hệ với chúng tôi để được hỗ trợ nhanh nhất</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

        <div class="col-lg-6">
            <div class="info-wrap">
              <div class="info-item d-flex">
                    <i class="bi bi-person flex-shrink-0"></i>
                    <div>
                        <h4>Họ tên:</h4>
                        <p>{{ $contact->name ?? 'Chưa cập nhật' }}</p>
                    </div>
                </div>

                <div class="info-item d-flex">
                    <i class="bi bi-telephone flex-shrink-0"></i>
                    <div>
                        <h4>Hotline:</h4>
                        <p>{{ $contact->hotline ?? 'Chưa cập nhật' }}</p>
                    </div>
                </div>

                <div class="info-item d-flex">
                    <i class="bi bi-envelope flex-shrink-0"></i>
                    <div>
                        <h4>Email:</h4>
                        <p>{{ $contact->email ?? 'Chưa cập nhật' }}</p>
                    </div>
                </div>

                <div class="info-item d-flex">
                    <i class="bi bi-geo-alt flex-shrink-0"></i>
                    <div>
                        <h4>Địa chỉ:</h4>
                        <p>{{ $contact->address ?? 'Chưa cập nhật' }}</p>
                    </div>
                </div>

                <div class="info-item d-flex">
                    <i class="bi bi-chat-dots flex-shrink-0"></i>
                    <div>
                        <h4>Zalo:</h4>
                        <p>{{ $contact->zalo ?? 'Chưa cập nhật' }}</p>
                    </div>
                </div>
            </div>
                
          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <label for="name-field" class="pb-2">Your Name</label>
                  <input type="text" name="name" id="name-field" class="form-control" required="">
                </div>

                <div class="col-md-6">
                  <label for="email-field" class="pb-2">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email-field" required="">
                </div>

                <div class="col-md-12">
                  <label for="subject-field" class="pb-2">Subject</label>
                  <input type="text" class="form-control" name="subject" id="subject-field" required="">
                </div>

                <div class="col-md-12">
                  <label for="message-field" class="pb-2">Message</label>
                  <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section>