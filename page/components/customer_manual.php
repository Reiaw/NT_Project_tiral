<!-- ./components/manual_modal.php -->
<div id="manualModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg w-1/2 p-6 max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold" id="modalTitle">คู่มือการใช้งาน</h2>
            <button onclick="closeModal()" class="text-gray-500 text-lg">&times;</button>
        </div>
        
        <!-- Content of the manual, each page will be inside a div -->
        <div id="manualContent" class="space-y-4 p-6 bg-gray-100 rounded-lg shadow-lg">
            <div class="manual-page block" id="page1">
                <h3 class="text-xl font-semibold text-blue-700">หน้าที่ 1: ภาพรวมของระบบ</h3>
                <img src="../img/C0-1.png" alt="รูปภาพ" class="w-full max-w-md mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">ในหน้าการจัดการลูกค้า สามารถเพิ่ม ลบ แก้ไขข้อมูลลูกค้า และจัดการประเภทของลูกค้าได้</p>
                <p class="text-gray-700 mt-2">ประกอบไปด้วย:</p>
                <ul class="list-disc list-inside text-gray-700 ml-4">
                    <li>การจัดการลูกค้าในระบบ</li>
                    <li>การจัดการประเภทของลูกค้า</li>
                    <li>การนำเข้าข้อมูลลูกค้า</li>
                    <li>การค้นหาลูกค้าด้วยตัวกรอง</li>
                    <li>การแสดงข้อมูลลูกค้า</li>
                </ul>
            </div>
            
            <div class="manual-page hidden" id="page2">
                <h3 class="text-xl font-semibold text-blue-700">หน้าที่ 2: การจัดการระบบลูกค้า</h3>
                <p class="text-gray-700">1. การเพิ่มลูกค้าโดยใช้ฟอร์ม จากปุ่มเพิ่มข้อมูลลูกค้า</p>
                <img src="../img/C1-1.png" alt="รูปภาพ" class="w-full max-w-md mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">ลักษณะของฟอร์มจะมีดังนี้:</p>
                <img src="../img/C1-2.png" alt="รูปภาพ" class="w-full max-w-md mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">ข้อมูลที่มีลักษณะดังนี้:</p>
                <ul class="list-disc list-inside text-gray-700 ml-4">
                    <li><strong>1.1. ชื่อลูกค้า:</strong> เป็นชื่อของหน่วยงานที่ใช้บริการ ไม่เกิน 100 ตัวอักษร (จำเป็น)</li>
                    <li><strong>1.2. ประเภทของลูกค้า:</strong> สามารถเลือกประเภทลูกค้าที่อยู่ในฐานระบบ (จำเป็น)</li>
                    <li><strong>1.3. เบอร์โทรศัพท์:</strong> ใส่เบอร์โทรศัพท์และสามารถใส่ชื่อของลูกค้าตามหลังได้ (ไม่จำเป็น)</li>
                    <li><strong>1.4. สถานะ:</strong> เลือกสถานะระหว่างใช้งานหรือไม่ใช้งาน (จำเป็น)</li>
                    <li><strong>1.5. อำเภอ:</strong> เลือกตำบลที่ตั้งหน่วยงาน (จำเป็น)</li>
                    <li><strong>1.6. ตำบล:</strong> เลือกอำเภอที่ตั้งหน่วยงาน (จำเป็น)</li>
                    <li><strong>1.7. ข้อมูลที่อยู่เพิ่ม:</strong> ใส่รายละเอียดเพิ่มเติมเกี่ยวกับที่อยู่ เช่น หมู่ ซอย ถนน (ไม่จำเป็น)</li>
                </ul>
                <p>ข้อควรระวัง</p>
                <ul class="list-disc list-inside text-gray-700 ml-4">
                    <li><strong>1.1. ชื่อลูกค้าจะต้องไม่ซ้ำกับในระบบ</strong></li>
                    <li><strong>1.2. เบอร์โทรศัพท์จำเป็นต้องมีอย่างน้อย 9 หลัก และใส่ชื่อตามหลังได้</strong></li>
                    <li><strong>1.3. กรุณาเลือกอำเภอก่อน เพื่อระบบจะกรองตำบลในอำเภอนั้น</strong> </li>
                    <li><strong>1.4. หากไม่มีเบอร์โทรศัพท์ไม่จำเป็นต้องใส่อะไร</strong></li>
                </ul>
                <p class="text-gray-700">2. การแก้ไขข้อมูลลูกค้าโดยใช้ฟอร์ม จากปุ่มแก้ไขข้อมูลลูกค้า</p>       
                <img src="../img/C1-3.png" alt="รูปภาพ" class="w-32 mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">ลักษณะของฟอร์มจะมีดังนี้:</p>
                <img src="../img/C1-4.png" alt="รูปภาพ" class="w-full max-w-md mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">แสดงข้อมูลลูกค้าจากในฐานระบบ โดยสามารถแก้ไขข้อมูลได้ทุกอย่างในฟอร์มนี้</p>
                <p>ข้อควรระวัง</p>
                <ul class="list-disc list-inside text-gray-700 ml-4">
                    <li><strong>2.1. การแก้ไชช้อมูลลูกค้าจำเป็นต้องมีรูปแบบที่เหมือนตอนเพิ่มลูกค้า</strong></li>
                </ul>
                <p class="text-gray-700">3. การลบลูกค้า จากปุ่มลบข้อมูลลูกค้า</p>
                <img src="../img/C1-5.png" alt="รูปภาพ" class="w-32 mx-auto my-4 rounded-lg shadow">
                <p>การลูกค้านั้น คือการนำข้อมูลลูกค้าออกจากฐานระบบ โดยจะขึ้นข้อความถามความต้องการอีกครั้งในการลบ</p>
                <img src="../img/C1-6.png" alt="รูปภาพ" class="w-full max-w-md mx-auto my-4 rounded-lg shadow">
                <p>ข้อควรระวัง</p>
                <ul class="list-disc list-inside text-gray-700 ml-4">
                    <li><strong>3.1. การลบข้อมูลลูกค้านั้นจะทำให้ข้อมูลของลูกค้าหายไปตลอดกาล ไม่สามารถกู้คืนได้</strong></li>
                    <li><strong>3.2. หากในระบบลูกค้ายังคงมีบิลหรือบริการอะไรอยู่ในระบบจะไม่สามารถลบออกไปได้</strong></li>
                    <img src="../img/C1-7.png" alt="รูปภาพ" class="w-full max-w-md mx-auto my-4 rounded-lg shadow">
                </ul>
            </div>
            <div class="manual-page hidden" id="page3">
                <h3 class="text-lg font-semibold">หน้าที่ 3: การจัดการประเภทลูกค้า</h3>
                <p class="text-gray-700">กดเข้าไปที่การจัดการลูกค้า เพื่อไปหน้าจัดการลูกค้า</p>
                <img src="../img/C2-1.png" alt="รูปภาพ" class="w-full max-w-md mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">ลักษณะของหน้าจัดการลูกค้าจะมีดังนี้:</p>
                <img src="../img/C2-2.png" alt="รูปภาพ" class="w-full max-w-md mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">1. การเพิ่มประเภทลูกค้า</p>
                <img src="../img/C2-3.png" alt="รูปภาพ" class="w-32 mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">ลักษณะของฟอร์มจะมีดังนี้:</p>
                <img src="../img/C2-4.png" alt="รูปภาพ" class="w-full max-w-md mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">สามารถเพิ่มประเภทลูกค้าที่ต้องการเข้าไปในระบบได้เลย </p>
                <p>ข้อควรระวัง</p>
                <ul class="list-disc list-inside text-gray-700 ml-4">
                    <li><strong>1.1. ประเภทลูกค้าจะต้องไม่ซ้ำกับในระบบ</strong></li>
                    <li><strong>1.2. ตรวจสอบประเภทลูกค้าก่อนจะเพิ่มเข้าไปใหม่ เพื่อไม่ให้มีข้อมูลซ้ำซอนเกินไป</strong></li>
                </ul>
                <p class="text-gray-700">2. การแก้ไขประเภทลูกค้า</p>
                <img src="../img/C1-3.png" alt="รูปภาพ" class="w-32 mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">ลักษณะของฟอร์มจะมีดังนี้:</p>
                <img src="../img/C2-5.png" alt="รูปภาพ" class="w-full max-w-md mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">สามารถแก้ไขประเภทลูกค้าจากเดิมได้ โดยจะเปลี่ยนแปลงชื่อประเภทลูกค้าที่ใช้ประเภทนี้ด้วย </p>
                <p class="text-gray-700">3. การลบประเภทลูกค้า</p>
                <img src="../img/C1-5.png" alt="รูปภาพ" class="w-32 mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">สามารถลบประเภทลูกค้าออกจากฐานข้อมูลได้</p>
                <p>ข้อควรระวัง</p>
                <ul class="list-disc list-inside text-gray-700 ml-4">
                    <li><strong>3.1. การลบประเภทลูกค้าออกจากฐานข้อมูล จะต้องไม่มีลูกค้าประเภทนี้อยู่ โดยสังเกตจาก จำนวนลูกค้า หากเป็น 0 ปุ่มลบจะเป็นสีแดงและสามารถลบได้แต่หากมีลูกค้าประเภมนี้อยู่ ปุ่มจะเป็นสีเทาและไม่สามารถกดลบได้</strong></li>
                    <img src="../img/C2-6.png" alt="รูปภาพ" class="w-full max-w-xl mx-auto my-4 rounded-lg shadow">  
                </ul>
            </div>

            <div class="manual-page hidden" id="page4">
                <h3 class="text-lg font-semibold">หน้าที่ 4: การนำเข้าข้อมูลโดย Excel</h3>
                <p>คำอธิบาย: การนำข้อมูล excel สามารถประหยัดเวลาในการนนำเข้าข้อมูลลูกที่ละหลายคน</p>
                <p>โดยเริ่มจากเลือกไฟล์ที่ excel ที่ต้องกดปุ่มเลือกไฟล์</p>
                <img src="../img/C3-1.png" alt="รูปภาพ" class="w-full max-w-md mx-auto my-4 rounded-lg shadow">
                <img src="../img/C3-2.png" alt="รูปภาพ" class="w-full max-w-md mx-auto my-4 rounded-lg shadow">
                <p>หลังจากเลือกไฟล์ให้กด นำเข้า excel ก็จะเสร็จสิ้น</p>
                <p>1.รูปแบบไฟล์ excel ที่ถูกต้อง</p>
                <img src="../img/C3-3.png" alt="รูปภาพ" class="w-full max-w-xl mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">ข้อมูลต้องมีตามหัวข้อลักษณะดังนี้:</p>
                <ul class="list-disc list-inside text-gray-700 ml-4">
                    <li><strong>1.1. Name:</strong> ใส่ชื่อของหน่วยงานที่ใช้บริการ ไม่เกิน 100 ตัวอักษร (จำเป็น)</li>
                    <li><strong>1.2. Type:</strong> ใส่ประเภทของลูกค้าโดยต้องตรงกับในฐานระบบ (จำเป็น)</li>
                    <li><strong>1.3. Phone:</strong> ใส่เบอร์โทรศัพท์และสามารถใส่ชื่อของลูกค้าตามหลังได้ (ไม่จำเป็น)</li>
                    <li><strong>1.4. Status:</strong> ใส่ระหว่างใช้งานหรือไม่ใช้งาน (จำเป็น)</li>
                    <li><strong>1.5. Address:</strong> ใส่ตำบลที่ตั้งหน่วยงานที่ตรงกับในฐานระบบ (จำเป็น)</li>
                    <li><strong>1.6. Tambon:</strong> ใส่อำเภอที่ตั้งหน่วยงานที่ตรงกับในฐานระบบ (จำเป็น)</li>
                    <li><strong>1.7. Amphure:</strong> ใส่รายละเอียดเพิ่มเติมเกี่ยวกับที่อยู่ เช่น หมู่ ซอย ถนน (ไม่จำเป็น)</li>
                </ul>
                <p>ข้อควรระวัง</p>
                <ul class="list-disc list-inside text-gray-700 ml-4">
                    <li><strong>1.1. ชื่อลูกค้าจะต้องไม่ซ้ำกับในระบบและจะตรงใส่ให้ครบทุกช่อง</strong></li>
                    <li><strong>1.2. ประเภทของลูกค้าจะต้องมีในฐานระบบ หากใส่ประเภที่ไม่มีในฐานระบบจะไม่สามารถทำงานได้</strong></li>
                    <li><strong>1.3. หากมีข้อมูลูกค้าคนเดิมระบบจะไม่ทำการเพิ่มลงไป</strong> </li>
                    <li><strong>1.4. เบอร์โทรศัพท์ไม่จำเป็นต้องใส่</strong></li>
                    <li><strong>1.5. หากใส่เบอร์โทรศัพท์จำเป็นต้องมี 9-10 หลัก โดยมีข้อความตามหลังได้</strong></li>
                    <li><strong>1.6. อำเภอและตำบลจำเป็นต้องใส่ให้ถูกต้องของในจังหวัดกาญจนบุรี</strong></li>
                </ul>
            </div>
            <div class="manual-page hidden" id="page5">
                <h3 class="text-lg font-semibold">หน้าที่ 5: การกรองข้อมูล</h3>
                <img src="../img/C3-4.png" alt="รูปภาพ" class="w-full max-w-xl mx-auto my-4 rounded-lg shadow">
                <p class="text-gray-700">คำอธิบาย: การกรองข้อมูลลูกค้า สามารถใช้เพื่อค้นหาข้อมูลลูกค้าที่ต้องการ โดยมีดังนี้</p>
                <ul class="list-disc list-inside text-gray-700 ml-4">
                    <img src="../img/C3-5.png" alt="รูปภาพ" class="max-w-md mx-auto my-4 rounded-lg shadow">
                    <li><strong>1.1.การค้นหาด้วยชื่อ : </strong>สามารถพิมพ์ชื่อหน่วยงานเพื่อใช้ในการค้นหา</li>
                    <img src="../img/C3-6.png" alt="รูปภาพ" class="max-w-md mx-auto my-4 rounded-lg shadow">
                    <li><strong>1.2.การค้นหาด้วยประเภท :</strong>เลือกประเภทของลูกค้าเพื่อกรองข้อมูลลูกค้าในประเภทนั้น</li>
                    <img src="../img/C3-7.png" alt="รูปภาพ" class="max-w-md mx-auto my-4 rounded-lg shadow">
                    <li><strong>1.3.การค้นหาด้วยอำเภอและตำบล : </strong>เลือกอำเภอและตำบลเพื่อกรองลูกค้าที่อยู่ในพื้นที่ดังกล่าว</li>
                    <img src="../img/C3-8.png" alt="รูปภาพ" class="w-32 mx-auto my-4 rounded-lg shadow">
                    <li><strong>1.4.ปุ่มรีเช็ต : </strong>ไว้สำหรับรีเช็ตข้อมูลลูกค้าที่ใช้กรอง</li>
                </ul>
                <p>ข้อควรระวัง</p>
                <ul class="list-disc list-inside text-gray-700 ml-4">
                    <li><strong>1.1. การกรองข้อมูลลูกค้าจะต้องใช้ข้อมูลที่ถูกต้องเท่านั้น</strong></li>
                    <li><strong>1.2. หากไม่มีข้อมูลที่ตรงกับในระบบจะไม่แสดงข้อมูลใดๆ</strong></li>
                </ul>
            </div>

        </div>

        <div class="flex justify-between items-center mt-6">
            <button onclick="prevPage()" class="bg-gray-500 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
            </button>
            
            <span id="pageNumber" class="text-lg font-semibold">1 / 5</span>
            
            <button onclick="nextPage()" class="bg-blue-500 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </div>
</div>
