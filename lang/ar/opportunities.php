<?php

return [
    'title' => 'الفرص التطوعية',
    'create_title' => 'إنشاء فرصة جديدة',
    'edit_title' => 'تعديل الفرصة',
    'show_title' => 'تفاصيل الفرصة',

    'descriptions' => [
        'create' => 'قم بتعبئة التفاصيل أدناه لنشر فرصة تطوعية جديدة.',
        'edit' => 'تحديث تفاصيل الفرصة ":title".',
        'show' => 'عرض معلومات الفرصة ":title".',
        'manage' => 'إدارة جميع الفرص التطوعية المسجلة وتفاصيلها.',
        'manager' => 'إدارة الفرص التطوعية التابعة لفرقك.',
        'browse' => 'تصفح الفرص التطوعية المتاحة وابحث عن أنشطة للانضمام إليها.',
    ],

    'actions' => [
        'back' => 'العودة للفرص',
        'create' => 'إنشاء فرصة',
        'edit' => 'تعديل',
        'update' => 'تحديث الفرصة',
        'delete' => 'حذف',
        'view' => 'عرض',
        'cancel' => 'إلغاء',
        'save' => 'حفظ الفرصة',
        'apply' => 'قدم الآن',
    ],

    'fields' => [
        'title' => 'عنوان الفرصة',
        'team' => 'الفريق',
        'type' => 'نوع الفرصة',
        'status' => 'الحالة',
        'location' => 'الموقع',
        'start_date' => 'تاريخ البدء',
        'end_date' => 'تاريخ الانتهاء',
        'application_deadline' => 'الموعد النهائي للتقديم',
        'required_volunteers' => 'عدد المتطوعين المطلوب',
        'hours' => 'الساعات',
        'description' => 'الوصف',
        'image' => 'صورة الفرصة',
        'is_active' => 'فرصة نشطة',
    ],

    'placeholders' => [
        'title' => 'مثال: مبادرة تنظيف الحي',
        'location' => 'مثال: عمّان، الأردن أو عن بُعد',
        'required_volunteers' => 'مثال: 10',
        'hours' => 'مثال: 20',
        'description' => 'وصف تفصيلي للفرصة...',
        'select_team' => '-- اختر الفريق --',
        'select_type' => '-- اختر النوع --',
        'select_status' => '-- اختر الحالة --',
    ],

    'upload' => [
        'upload_file' => 'ارفع ملفاً',
        'upload_new_file' => 'ارفع ملفاً جديداً',
        'file_types' => 'صيغ JPG, JPEG, PNG, WEBP بحجم يصل إلى 2MB',
        'current_image' => 'الصورة الحالية',
        'replace_image' => 'ارفع ملفاً جديداً أدناه لاستبدالها.',
    ],

    'types' => [
        'onsite' => 'حضوري',
        'remote' => 'عن بُعد',
        'hybrid' => 'مدمج (هجين)',
    ],

    'statuses' => [
        'draft' => 'مسودة',
        'published' => 'منشورة',
        'closed' => 'مغلقة',
        'completed' => 'مكتملة',
        'cancelled' => 'ملغاة',
    ],

    'misc' => [
        'not_available' => 'غير متوفر',
        'active_status' => 'حالة النشاط',
        'active' => 'نشط',
        'inactive' => 'غير نشط',
        'created' => 'تاريخ الإنشاء',
        'updated' => 'تاريخ التحديث',
        'hours_suffix' => 'ساعات',
        'actions' => 'الإجراءات',
        'active_description' => 'أبقِ هذه الفرصة متاحة ومرئية في النظام.',
    ],

    'empty' => [
        'no_description' => 'لم يتم توفير وصف.',
        'no_opportunities' => 'لم يتم العثور على فرص.',
        'create_first' => 'قم بإنشاء فرصتك التطوعية الأولى للبدء.',
        'no_active_opportunities' => 'لا توجد فرص نشطة متاحة حالياً.',
    ],

    'application' => [
        'interested' => 'مهتم بهذه الفرصة؟',
        'prompt' => 'قدم طلبك وكن جزءاً من هذه الفرصة التطوعية.',
        'closed' => 'باب التقديم مغلق حالياً لهذه الفرصة.',
    ],

    'messages' => [
        'delete_confirmation' => 'هل أنت متأكد من أنك تريد حذف هذه الفرصة؟',
    ],
    'sections' => [
    'basic_information' => 'المعلومات الأساسية',
    'schedule_capacity' => 'الجدول الزمني والسعة',
    'description_media' => 'الوصف والوسائط',
    'availability' => 'حالة الفرصة',
    'basic_information_description' => 'قم بتحديد التفاصيل الرئيسية للفرصة التطوعية.',
    'schedule_capacity_description' => 'حدد التوقيت وعدد المتطوعين المطلوبين للفرصة.',
    'description_media_description' => 'أضف وصفًا واضحًا وصورة اختيارية للفرصة.',
    ],

    'messages' => [
    'correct_errors' => 'يرجى تصحيح الأخطاء الموضحة أدناه.',
    'review_fields' => 'بعض الحقول تحتاج إلى مراجعتك قبل إنشاء الفرصة.',
    'active_help' => 'اجعل هذه الفرصة متاحة ومرئية في النظام.',
    ],
];