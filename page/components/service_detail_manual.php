<div id="manualModal" class="hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center z-50 p-4 mt-20">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-2xl font-bold text-gray-800">คู่มือการใช้งานระบบ</h2>
            <button onclick="closeModalA()" class="text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Content -->
        <div class="overflow-y-auto flex-1 p-6">
            <div class="space-y-8">
                <!-- Page 1 -->
                <div class="manual-page block" id="page1">
                    <div class="prose max-w-none">
                        <h3 class="text-2xl font-bold text-blue-600 mb-4">หน้าที่ 1: ภาพรวมของระบบ</h3>
                        <p class="text-gray-700 text-gl leading-relaxed">
                        ในหน้ารายละเอียดบริการของลูกค้า
                        </p>
                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <img src="../img/service_detail/SD0.1.png" alt="ภาพรวมระบบ" class="w-full rounded-lg border border-gray-200 mb-4">
                            
                            <div class="grid md:grid-cols-1 gap-4">
                                <div class="bg-white p-4 rounded-lg border border-gray-200">
                                    <h4 class="font-semibold text-gray-800 mb-2">ส่วนประกอบหลัก:</h4>
                                            <ul class="list-disc pl-5 ">
                                                <li>การแสดงรายละเอียดบริการ</li>
                                                <li>การเพิ่มแพ็กเกจของบริการ</li>
                                                <li>การเพิ่มโปรดักต์ของบริการ</li>
                                                <li>การแสดงโปรดักต์ของบริการ</li>
                                            </ul>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page 2 -->
            <div class="manual-page block" id="page2">
                <div class="prose max-w-none">
                    <h3 class="text-2xl font-bold text-blue-600 mb-4">หน้าที่ 2: การจัดการ Package และ Product</h3>
                    <p class="text-gray-700 leading-relaxed">
                            ในหน้าจัดการ Package และ Product ของลูกค้า สามารถเพิ่ม ลบ แก้ไขข้อมูล Package และ Product ของลูกค้าได้</p>
                        <p class="text-gray-700 text-xl font-bold mt-2">2.1. การเพิ่ม Package และ Product โดยใช้ฟอร์ม จากปุ่มเพิ่ม Package</p>
                        <img src="../img/service_detail/SD1.2.png" alt="การเพิ่มPackage" class="w-full rounded-lg border border-gray-200 mb-4">
                        <p class="text-gray-700 text-gl leading-relaxed">ลักษณะของฟอร์มจะมีดังนี้:</p>
                        <img src="../img/service_detail/SD1.3.png" alt="การเพิ่มPackage" class="w-full rounded-lg border border-gray-200 mb-4">
                        <p class="text-gray-700 text-gl leading-relaxed">การเพิ่ม Product จากปุ่มเพิ่ม Product</p>
                        <p class="text-gray-700 text-gl leading-relaxed">ลักษณะของฟอร์มจะมีดังนี้:</p>
                        <img src="../img/service_detail/SD1.4.png" alt="การเพิ่มProduct" class="w-full rounded-lg border border-gray-200 mb-4">
                        <p class="text-gray-700 text-gl leading-relaxed">กรอกข้อมูล Package ตามรายละเอียดต่อไปนี้:</p>
                        <!-- ตารางแสดงข้อมูล -->
                            <table class="table-auto w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="border border-gray-300 px-4 py-2 text-left">ประเภทข้อมูล</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">คำอธิบาย</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">ข้อกำหนด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">ชื่อ Package</td>
                                        <td class="border border-gray-300 px-4 py-2">ชื่อ Package ที่ใช้บริการ</td>
                                        <td class="border border-gray-300 px-4 py-2">- จำเป็นต้องกรอก<br>- ชื่อ Package สามารถซ้ำกับที่มีอยู่แล้วในระบบ</td>
                                    </tr>
                                    <tr class="bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2">ข้อมูล Package</td>
                                        <td class="border border-gray-300 px-4 py-2">ข้อมูล Package ที่ใช้บริการ</td>
                                        <td class="border border-gray-300 px-4 py-2">- ไม่จำเป็นต้องกรอก</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">วันที่สร้าง</td>
                                        <td class="border border-gray-300 px-4 py-2">วันที่ติดตั้ง Package และ Product</td>
                                        <td class="border border-gray-300 px-4 py-2">- จำเป็นต้องเลือก</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">เพิ่ม Product</td>
                                        <td class="border border-gray-300 px-4 py-2">-</td>
                                        <td class="border border-gray-300 px-4 py-2">- ไม่จำเป็นต้องเพิ่ม</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="text-gray-700 text-gl leading-relaxed">กรอกข้อมูล Product ตามรายละเอียดต่อไปนี้:</p>
                        <!-- ตารางแสดงข้อมูล -->
                            <table class="table-auto w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="border border-gray-300 px-4 py-2 text-left">ประเภทข้อมูล</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">คำอธิบาย</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">ข้อกำหนด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">ชื่อ Product</td>
                                        <td class="border border-gray-300 px-4 py-2">ชื่อ Product ที่ใช้บริการ</td>
                                        <td class="border border-gray-300 px-4 py-2">- จำเป็นต้องกรอก<br>- ชื่อ Product สามารถซ้ำกับที่มีอยู่แล้วในระบบ</td>
                                    </tr>
                                    <tr class="bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2">ข้อมูล Product</td>
                                        <td class="border border-gray-300 px-4 py-2">ข้อมูล Product ที่ใช้บริการ</td>
                                        <td class="border border-gray-300 px-4 py-2">- ไม่จำเป็นต้องกรอก</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">ราคา</td>
                                        <td class="border border-gray-300 px-4 py-2">ราคา Main Package<br>ราคา Main ICT Solution</td>
                                        <td class="border border-gray-300 px-4 py-2">- จำเป็นต้องกรอก</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">ข้อมูลเพิ่มเติม</td>
                                        <td class="border border-gray-300 px-4 py-2">-</td>
                                        <td class="border border-gray-300 px-4 py-2">- ไม่จำเป็นต้องกรอก</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="bg-yellow-100 p-4 rounded-lg border-l-4 border-yellow-500 mt-6">
                            <h4 class="text-lg font-bold text-yellow-700 flex items-center">
                                    <svg class="w-6 h-6 text-yellow-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.766-1.36 2.72-1.36 3.486 0l6.518 11.57c.746 1.325-.187 2.981-1.743 2.981H3.482c-1.556 0-2.489-1.656-1.743-2.981l6.518-11.57zM11 14a1 1 0 11-2 0 1 1 0 012 0zm-1-2a1 1 0 001-1V7a1 1 0 00-2 0v4a1 1 0 001 1z" clip-rule="evenodd"></path>
                                    </svg>
                                    ข้อควรระวัง
                                </h4>
                                <ul class="list-disc pl-8 text-gray-700 mt-2">
                                    <li>วันที่ติดตั้ง Package และ Product จำเป็นต้องเลือก</li>
                                    <li>ราคาMain Package และราคา Main ICT Solution ต้องกรอกให้ครบถ้วน</li>
                                    <li>การเพิ่ม Product สามารถเพิ่มภายหลังได้</li>             
                                </ul>
                            </div>

                    <p class="text-gray-700 text-xl font-bold mt-2">2.2. การแสดงข้อมูล Product</p>
                    <p class="text-gray-700 text-gl leading-relaxed">เมื่อกดปุ่มนี้จะสามารถดูรายละเอียดของ Product </p>
                    <img src="../img/service_detail/SD1.5.png" alt="การแสดงข้อมูล"class="w-1/2 mx-auto rounded-lg border border-gray-200 mb-4">
                    <p class="text-gray-700 text-gl leading-relaxed">ดังรูปนี้</p>
                    <img src="../img/service_detail/SD1.6.png" alt="การแสดงข้อมูล"class="w-full rounded-lg border border-gray-200 mb-4">
                    <div class="grid md:grid-cols-1 gap-4">
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <h4 class="font-semibold text-gray-800 mb-2">รายละเอียดแสดงข้อมูล Product :</h4>
                            <ul class="list-disc pl-5">
                                <li><strong>ชื่อ Product</strong></li>
                                <li><strong>ข้อมูล Product</strong></li>
                                <li><strong>ราคา MainPackage</strong></li>
                                <li><strong>ราคา ICT Solution (ถ้ามี)</strong></li>
                                <li><strong>รวม</strong></li>
                                <li><strong>รายละเอียด</strong></li>
                                <li><strong>วันที่เริ่ม</strong></li>
                            </ul>
                        </div>
                        <p class="text-gray-700 text-xl font-bold mt-2">2.3. การแก้ไขข้อมูล Product คลิกที่ปุ่ม Edit</p>
                        <p class="text-gray-700 text-gl leading-relaxed">เมื่อกดปุ่มนี้จะสามารถแก้ไขละเอียดของ Product ในฟอร์มที่แสดงขึ้นและคลิกปุ่ม "บันทึก" เพื่อบันทึกการเปลี่ยนแปลง </p>
                        <img src="../img/service_detail/SD1.7.png" alt="การแสดงข้อมูล"class="w-1/2 mx-auto rounded-lg border border-gray-200 mb-4">
                        <p class="text-gray-700 text-gl leading-relaxed">ดังรูปนี้</p>
                        <img src="../img/service_detail/SD1.8.png" alt="การแสดงข้อมูล"class="w-full rounded-lg border border-gray-200 mb-4">

                        <p class="text-gray-700 text-xl font-bold mt-2">2.4. การลบข้อมูล Product คลิกที่ปุ่ม Delete</p>
                        <p class="text-gray-700 text-gl leading-relaxed">เมื่อกดปุ่มนี้จะสามารถลบละเอียดของ Product และยืนยันการลบข้อมูลในกล่องข้อความที่ปรากฏ </p>
                        <img src="../img/service_detail/SD1.9.png" alt="การแสดงข้อมูล"class="w-1/2 mx-auto rounded-lg border border-gray-200 mb-4">
                        <p class="text-gray-700 text-gl leading-relaxed">ดังรูปนี้</p>
                        <img src="../img/service_detail/SD2.0.png" alt="การแสดงข้อมูล"class="w-full rounded-lg border border-gray-200 mb-4">
                        </div>
                    <div class="bg-yellow-100 p-4 rounded-lg border-l-4 border-yellow-500 mt-6">
                            <h4 class="text-lg font-bold text-yellow-700 flex items-center">
                                    <svg class="w-6 h-6 text-yellow-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.766-1.36 2.72-1.36 3.486 0l6.518 11.57c.746 1.325-.187 2.981-1.743 2.981H3.482c-1.556 0-2.489-1.656-1.743-2.981l6.518-11.57zM11 14a1 1 0 11-2 0 1 1 0 012 0zm-1-2a1 1 0 001-1V7a1 1 0 00-2 0v4a1 1 0 001 1z" clip-rule="evenodd"></path>
                                    </svg>
                                    ข้อควรระวัง
                                </h4>
                                <ul class="list-disc pl-8 text-gray-700 mt-2">
                                    <li>ควรตรวจสอบข้อมูลก่อนและหลังการแก้ไข</li>
                                    <li>ควรตรวจสอบข้อมูลก่อนทำการลบ</li>            
                                </ul>
                            </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="border-t px-6 py-4 bg-gray-50">
            <div class="flex justify-between items-center">
                <button onclick="prevPage()" class="px-5 py-2.5 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    ก่อนหน้า
                </button>
                
                <div class="flex items-center space-x-2">
                    <span class="text-gray-600">หน้า</span>
                    <span id="pageNumber" class="font-semibold text-blue-600 w-12 text-center">1 / 5</span>
                </div>

                <button onclick="nextPage()" class="px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition-colors flex items-center">
                    ถัดไป
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom scrollbar */
    #manualModal ::-webkit-scrollbar {
        width: 8px;
    }
    #manualModal ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    #manualModal ::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 4px;
    }
    #manualModal ::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }

    /* Warning box */
    .warning-box {
        @apply bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4;
    }
</style>