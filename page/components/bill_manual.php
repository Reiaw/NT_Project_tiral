<!-- ./components/manual_modal.php -->
<div id="manualModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg w-1/2 p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold" id="modalTitle">คู่มือการใช้งาน</h2>
            <button onclick="closeModal()" class="text-gray-500 text-lg">&times;</button>
        </div>
        
        <!-- Content of the manual, each page will be inside a div -->
        <div id="manualContent" class="space-y-4">
            <div class="manual-page">
                <h3 class="text-lg font-semibold">หน้าที่ 1: การเพิ่มลูกค้า</h3>
                <p>คำอธิบายวิธีการเพิ่มลูกค้าในระบบ...</p>
            </div>
            <div class="manual-page hidden">
                <h3 class="text-lg font-semibold">หน้าที่ 2: การแก้ไขข้อมูลลูกค้า</h3>
                <p>คำอธิบายวิธีการแก้ไขข้อมูลลูกค้า...</p>
            </div>
            <div class="manual-page hidden">
                <h3 class="text-lg font-semibold">หน้าที่ 3: การลบลูกค้า</h3>
                <p>คำอธิบายวิธีการลบลูกค้า...</p>
            </div>
        </div>

        <div class="flex justify-between items-center mt-6">
            <button onclick="prevPage()" class="bg-gray-500 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
            </button>
            
            <span id="pageNumber" class="text-lg font-semibold">1 / 3</span>
            
            <button onclick="nextPage()" class="bg-blue-500 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </div>
</div>
