<section class="bg-gray-50 min-h-screen flex items-center justify-center">
    <!-- login container -->
    <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">
        <!-- form -->
        <div class="md:w-1/2 px-8 md:px-16">
            <h2 class="font-bold text-2xl text-[#002D74]">Register</h2>
            <p class="text-xs mt-4 text-[#002D74]">Register disini ya</p>

            <form action="<?= base_url('autentifikasi/register'); ?>" class="user flex flex-col gap-4" method="POST">
                <input type="text" class="p-2 mt-8 rounded-xl border" id="nama" name="nama" placeholder="Nama" value="<?= set_value('nama'); ?>">
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>

                <input class="p-2 rounded-xl border" id="email" type="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                <?= form_error('email', '<small class="text-danger pl-3>">', '</small>'); ?>

                <div class="relative">
                    <input class="p-2 rounded-xl border w-full" type="password" name="password1" placeholder="Password">
                    <?= form_error('password1', '<small class="text-danger pl-3>">', '</small>'); ?>
                </div>
                <!-- Password2 -->
                <div>
                    <input class="p-2 rounded-xl border w-full" type="password" name="password2" placeholder="Ulangi Password">
                    <?= form_error('password2', '<small class="text-danger pl-3>">', '</small>'); ?>
                </div>
                <button class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300" type="submit">Register</button>
            </form>

            <div class="mt-1 text-xs py-4 text-[#002D74]">
                <a href="<?= base_url('autentifikasi'); ?>">Sudah punya akun?</a>
            </div>
        </div>

        <!-- image -->
        <div class="md:block hidden w-1/2">
            <img class="rounded-2xl" src="https://images.unsplash.com/photo-1616606103915-dea7be788566?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1887&q=80">
        </div>
    </div>
</section>