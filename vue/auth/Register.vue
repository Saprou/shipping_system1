<template>
  <div class="register-page" :style="'direction:' + $genStore.getters.getDir">
    <section class="terms" v-if="termsToggler">
        <div>
            <header>
                <h3>Terms & conditions</h3>
                <p>Please read the full terms and conditions before you accept them</p>
            </header>
            <div>
                <h2>اولا. التأمين على شحنات الطرف الثاني</h2>
                <h3>1- خدمة التأمين:</h3>
                <p>
                    باستطاعة الطرف الثاني اختيار خدمة التأمين على الشحنات الخاصة به، مما يعني أنه في حال التأمين،
                    فعلى الطرف الثاني دفع مبلغ تأمين تكون قيمته بحسب خطة التأمين المختارة (أنظر الخيارات أدناه)، وفي هذه الحال،
                    فإن الطرف الاول مسئول  عن تعويض الطرف الثاني عن قيمة الشحنات في حالة الضياع أو التلف بحسب قيمة التحصيل
                    المقررة في البوالص التابعة لهذه الشحنات. إن الخيار ج سيكون خطة التأمين التلقائية للطرف الثاني 
                    في هذه المرحلة من تسجيل الحساب، وفي حال أراد الطرف الثاني تغيير هذه الخطة واعتماد خيار آخر،
                    سوف يتمكن من ذلك من خلال التواصل معنا عن طريق البريد الالكترونى وابعلاغنا بالخطه التى يريد الاشتراك فيها او اختيارها

                    الخيار أ
                    يقوم الطرف الاول  بإرسال فاتورة للطرف الثاني بقيمة نصف بالمئة من قيمة الشحنة التي يستلمها الطرف الأول من الطرف الثاني بحسب القيمة المعلنة لهذه الشحنة، وفي هذه الحال، يكون الطرف الاول ملزم بتعويض الطرف الثاني بقيمة 75% من قيمة الشحنات الفردية التي يتم تحديدها ضائعة أو تالفة، بحيث أن الحد الأقصى للتعويض عن كل شحنة هو 3500 (ثلاثه آلاف وخمسمائة) جنيه مصري في الخيار "أ"

                    الخيار ب
                    يقوم الطرف الاول  بإرسال فاتورة للطرف الثاني بقيمة واحد بالمئة 1% من قيمة الشحنة التي يستلمها الطرف الأول من الطرف الثاني بحسب القيمة المعلنة لهذه الشحنة، وفي هذه الحال، يكون الطرف الاول ملزم بتعويض الطرف الثاني بقيمة 100% من قيمة الشحنات الفردية التي يتم تحديدها ضائعة أو تالفة، ، بحيث أن الحد الأقصى للتعويض عن كل شحنة هو 5000 (خمسه آلاف) جنيه مصري في حال الخيار "ب".

                    الخيار ج
                    يختار الطرف الثاني عدم التأمين على الشحنات، وفي هذه الحال تلتزم بوسطة بتعويضكم عن أي ضياع أو تلف بمبلغ 500 (خمسمائة) جنيه مصري فقط كحد أقصى على الشحنة الواحدة أو القيمة المعلنة على بوليصة الشحنة التالفة أو الضائعة، أيهما أقل.

                </p>
                <h3>2-شروط التعويض*:</h3>
                <p>
                    في حالة تسليم شحناتك إلينا بدون مواد التغليف المخصصة لذلك او بدون الحاق بوليصة الشحن في المكان المخصص في أكياس الشحن، يمكن ان يؤدي ذلك الي ضياع الشحنة و ذلك سيكون علي مسؤولية جانبك ، و بصفتك شريكنا ، فإننا نقدر اتباع هذه الإجراءات الهامة لضمان سلامة شحنات عملائك.
                    يجب أن يتم الإبلاغ عن حالة التلف أو الضياع في الحال عند اثبات الحالة (مثلا في لحظة استلام المرتجعات). ولن يقوم الطرف الاول  بأي تعويضات في حالة التأخر عن الإبلاغ مده اقصاها 30 يوم من تاريخ استلام الطرف الاول الشحنه ، و الطرف الاول غير مسؤول عن أي ضياع أو تلف في حال عدم أو تجاوز المده السابقه للإبلاغ.
                    بعد الإبلاغ، لدى الطرف الاول  مدة أقصاها 14 يوما للتحقيق الداخلي.
                    إن الطرف الثاني مسؤول مسؤولية كاملة عن أي منتج من اللائحة التالية للمنتجات الممنوعة، أو الشحنات المغلفة بطريقة خاطئة أو مخالفة لطريقة التغليف السليمة تعرضها للتلف (يرجى مراجعة دليلنا الخاص بطرق التغليف السليمة- الرابط في الملحق)، أو أي شحنات تفوق قيمتها الفردية العشرة آلاف جنيه مصري.
                    * يرجى مراجعة المقطع الخاص بطريقة الخطوات والبنود التي يجب اتباعها في حال التلف أو الضياع، مراجعة دقيقة (الرابط في الملحق)

                    --
                    فى حاله تغليف الطرف الثانى المنتجات عن طريقه فلا يحق له الرجوع على الطرف الاول بالتعويض فى حاله تلف الشحنه 
                    او المنتج المراد شحنه او نقله ويتحمل الطرف الثانى مسئوليه تلف الشحنه

                    ----
                    يلتزم الطرف الثانى بالتاكيد ان البيانات الخاصه به مطابقه وصحيحه من حيث الاصناف والتسعيره
                    والفواتير وابلاغ الطرف الاول قبل يومين على الاقل عن التغير  معرف مسبقا قد يؤدى الى الغاء الاوردر
                    (والايحق للطرف  الاول تعويض الطرف الثانى اذا تم تسليم العميل الاوردر قبل ان يتم تعديل السعر  )
                </p>
                <h3>3-المنتجات الممنوعة منعا باتا:</h3>
                <p>
                    البشر أو الحيوانات-----
                    أي مواد طعام أو شرب معرضة للتلف--------
                    أي منتجات مسروقة، غير قانونية، احتيالية أو تم الحصول أو بيعها بطريقة الاحتيال، أو أي منتج غير مصرح لكم بشحنه أو إرساله.------
                    أي منتجات حساسة أو معرضة للكسر أو\و مغلفة بشكل سئ لا يتماشى بالطرق المنصوح بها في بوسطة------
                    أي مشروبات كحولية \روحية ومنتجات التبغ--------
                    المنتجات التي لم يتم الحصول على التصاريح القانونية اللازمة من الجهات المختصة لبيعها أو توزيعها للمستهلك بحسب القوانين المصرية.------
                    أدوات أو معدات اتصالات أو إلكترونية غير قانونية بحسب القانون المصري---------
                    مواد قابلة للإنفجار أو الاشتعال--------
                    تغيير عملات--------
                    أدوات أو معدات خطرة قد تؤذي الغير أو تودي بحايتهم( أسلحة بكل أنواعها، متفجرات، بطاريات سيارات على سبيل المثال ولا الحصر)---------
                    شيكات بنكية، كتب ضمان، أو أي مستندات أصلية أو أوراق لها قيمة مالية أو لا يمكن تعويضها----------
                    أي منتجات تفوق قيمتها العشرة آلاف جنيه مصري 10000 ج.م-------------  
                </p>
                <h2>ثانيا:شروط واحكام اخرى</h2>
                <p>
                    تعهد الطرف الثاني في إطار الخدمات المقدمة من الطرف الأول موضوع التعاقد، بعدم القيام بأي أعمال غير قانونية أو غير أخلاقية أو بأي عمليات احتيال أو تحايل أو بأي أعمال ذات أهداف مخالفة للقوانين المصرية ومخالفة للمصلحة العامة. ويصرح الطرف الثاني أن استخدامه للخدمات المقدمة من الطرف الأول في إطار هذا العقد أو الشروط والأحكام هو استخدام في إطار القوانين المصرية، وعلى سبيل المثال لا الحصر قد تكون هذه القوانين تابعة للقوانين المالية، تبييض الأموال، المخالفات التجارية، والعمليات الإرهابية، ويتحمل الطرف الثاني مسؤولية محتوى الشحنات التابعة له مسؤولية كاملة وخالصة. ويقر الطرف الثانى بإلتزامه بقوانین جمهوریة مصر العربیة فى الحصول على المنتج المراد شحنه وبصلاحیته للاستخدام وأنه قد إستوفى وحصل على التراخیص والتصاریح والموافقات اللازمة لتصیر صالحة لعملائه بمجرد التوصیل عن طریق الطرف الاول.
                    يوافق الطرف الثاني أن لدى الطرف الأول الحق الكامل في إنهاء التعاقد فورا ومن دون أي سابق إنذار في حال تورط الطرف الثاني في أي نشاط غير قانوني أو غير أخلاقي أو استخدام خدمات الطرف الأول لأهداف غير قانونية أو غير أخلاقية، وعلى سبيل المثال لا الحصر:
                    استخدام الطرف الثاني لخدمات الطرف الأول بهدف غير قانوني أو غير أخلاقي أو احتيال أو أسباب فاحشة أو أي أعمال ممنوعة من قبل القانون المصري أو الجهات القانونية أو الرسمية أو الحكومية في جمهورية مصر العربية.
                    أن يكون المنتج المشحون مخالف لأي من القوانين المصرية أو شروط وأحكام هذا العقد.
                    يقر الطرف الثاني أن موظفيه التابعين له والممثلين له يتحملون مسؤولية كيفية استعمال خدمات الطرف الأول، وأن موظفي وممثلي وشركاء الطرف الثاني يأخذون مأخذ الطرف الثاني وتقع عليهم المسؤولية القانونية في إطار شروط وأحكام هذا العقد بخلاف الطرف الأول وموظفيه وممثليه.
                    يتعهد الطرف الثاني بعدم شحن شيكات على بياض أو بإشارة لحامله مع الطرف الأول.
                    الطرف الثاني مسؤول مسؤولية كاملة عن كيفية وطريقة تغليف الشحنات التابعة له، وفي حال عدم اتباع الطرف الثاني إرشادات التغليف السليم، لا يتحمل الطرف الأول أي مسؤولية جزئية أو كلية في حال حدوث تلف لمنتجات الطرف الثاني المشحونة مع الطرف الأول.
                    مدة هذا العقد سنة من تاريخ التعاقد قابله للتجديد لمدة أو مدد أخرى مساوية بزيادة 10% على الأسعار لكل مدة.
                    أسعار هذا التعاقد عرضة للزيادة المفاجئة بسابق إنذار يومين في حال زيادة أسعار البترول\البنزين في مصر.
                    يمكن إلغاء التعاقد من قبل أي من الطرفين بإعطاء إنذار من خلال البريد الإلكتروني ثلاثون يوما قبل الإلغاء.
                    يحتفظ الطرف الأول بحق الإفصاح عن معلومات وبيانات الطرف الثاني الشخصية لأي جهة أمنية مصرية تحت طلب مصرح وقانوني من هذه الجهة الأمنية وذلك تحت غطاء القوانين المصرية ، بموجب حكم قضائي نهائي.
                    فى حالة نشوء أي نزاع حول تنفيذ أو تفسير هذا العقد تختص محاكم القاهرة بالنظر و الفصل فيه و تسويته.
                    حال نشوء خلافات حول تفسير بنود العقد، یعتد باللغه العربیه وتكون محاكم القاهرة هي المختصة بالفصل فى النزاع.
                    تسري أحكام القانون المصري بما يتضمنه من قوانين واللوائح التنفيذية المعمول بها والقرارات الوزارية علي طرفي هذا العقد فيما يتعلق بكافة المسائل التي لم ينظمها أو يتضمنها هذا العقد.
                    فموجب هذا التعاقد یقوم الطرف الاول باستلام الشحنات الخاصة بالطرف الثاني، والمغلفة بمعرفة الطرف الثاني بفلايرز العائدة للطرف الأول والمطبوع علیها أسم الطرف الاول ثم يتم إقفالها وختمها بمعرفة الطرف الثاني ویلتزم الطرف الثانى بوضع المنتج الخاص به المراد توصیله لعملاء الطرف الثانى فیها ویقوم بغلق العبوه بمعرفته ووضع علیها اسم العمیل والعنوان المراد التوصیل إلیه وبیانات الشحنه وقیمتها وهومسؤول مسؤولية كاملة عن المحتوى داخل الشحنة جنائیا ومدنیا وسیاسیا ولیس للطرف الاول مسؤولية تجاهها.
                    اتفق الطرفان أن المنتج الذي بداخل الفلاير أصبح شحنة للتوصیل من قبل الطرف الاول وتابعیه فقط وأنه لیس له ولایه علیها وإنما توصیل وتحصیل فقط.
                    أقر الطرفان بصحه العناوین والبرید الالكترونى المبین فى صدر العقد وأن أیه مراسلات تتم بینهم تكون نافذه فى حقهم قانونا سواء باللغة العربیة أو اللغة الانجلیزیة.
                    لا يوجد فى هذه الاتفاقية ما ينتج عنه شراكة أو وكالة أو علاقة تبعية بين الطرفين أو أن يكون لأي طرف السلطة أو القوة لخلق أي إلتزامات على عاتق الطرف الآخر بأي طريقة أو سبب أو إبرام أي تعاقدات أو تقديم أية تعهدات بإسم الطرف الآخر
                    -------------
                    تطبق ضريبه القيمه المضافه طبقا للائحه التنفيذيه الخاصه بها فى جمهوريه مصر العربيه 

                    -----
                    يتحمل الطرف الاول مسوليه التحصيل من العملاء والمبلغ المحصل وهو قيمه الفاتوره من الطرف الثانى
                    مضافا اليها قيمه الشخن و النقل   الحاصه بالطرف الاول ويحتفظ الطرف الاول
                    بحق زياده او نقص قيمه الشحن فى اى وقت بناء على التقدير الخاص به فقط 
                    ----
                    يتعهد الطرف الثانى بان الاسعار التى يتم تسجيلها على الموقع الالكترونى هى الاسعار التى يقوم 
                    الطرف الاول بتحصيلها من العميل الخاص بالطرف الثانى وهذه الاسعار شامله
                    اسعار الشحن يقوم الطرف الثانى اضافتها من نفسه على المنتج المراد شحنه او نقله 
                    ---
                    يجب على الطرف الثانى ابلاغ الطرف الاول باى فروقات فى الاسعار وطلب  تعديلها والطرف الثانى
                    وحده مسءؤل عن مطابقه الاسعار على الموقع وفى حال فشل 
                    الطرف الثانى فى ذلك يتوجب عليه قبول الاسعار التى تم اضافتها على الموقع ولا يحق للطرف الاول تعويضه 
                    ----
                    يلتزم الطرف الثانى بدفع تكاليف نقل الشحنه او البضاعه الى مخازن الطرف الاول وتكاليف شحن المنتج
                    الى العميل فى حاله عدم استلام عميل الطرف الثانى الشحنه او البضاعه 
                    -----
                    اتفق الطرفان 
                    ان الموقع تحت الاختبار "التجربه "لمده ثلاث
                    شهور  ومن ثم فانه خلال تلك الفتره لا يعتد باى تعاملات على
                    الموقع والتعامل المعتد به هو تعامل ورقى 
                    -----
                    يتحمل الطرف الثانى تكاليف الشحن او النقل اذا قام عميل الطرف الثانى برفض او عدم اصتلام المنتجات 
                    ------
                    يلتزم الطرف الثانى بتقديم كافه الفواتير الضرييه الخاصه بالمنتجات التى يقوم الطرف الاول
                    بتوصيلها بنقلها وتقديم الاوراق اللزمه لاى جهه رسميه او حكوميه وقت طلبها
                    ------
                    يحق لطرف الاول الاعتماد على شركات نقل اوشحن  او شحن بريدى  اخرى فى حاله الحاجه الى ذلك 
                    ---
                    اتفق الطرفان على ان البريد الاكترونى والموقع الالكترونى الخاص بالشركه 
                    هما وسيلتى التواصل وعرض المشكلات التى قد تواجه الطرف الثانى والتى 
                    يتم التواصل من خلالهم واى وسيله اخرى لا تعتبر وسيله تواصل يعتد بها
                    لتعريف الطرف الاول المشاكل الى تواجهه والطرف غير مسئول 
                    عن حل اى مشكله لم يتم عرضها عن طريق هاتين الوسيلتين 
                    ------
                    اتفق الطرفان على ان اى شحنه يتجاوز سعرها 500 جنيها تثبت بالكتابه
                    او فاتوره يستمله الطرف الثانى من الطرف الاول
                    ----
                    اتفق الطرفان انه يجب وضع ملصق على الشحنه  مطبوع او مكتوب بخط
                    اليد موضح بها الوصف الخاص
                    بالشحنه والسعر والعنوان تفصيلى وارقام الهاتف الخاصه بالعميل 
                    المراد التوصيل اليه الشحنه توضيح تمحى الجهاله للطرف الاول  
                    ----
                    اتفق الطرفان انا لطرف الثانى مسؤؤل عن اى خسائر يتكبدها الطرف الاول اذا 
                    تم فرض غرامات على الطرف الاول بسبب الفواتير الضريبيه
                    او الاوراق الرسميه التي تثبت عدم وجود تراخيص
                    او فواتير للمنتجات التى ينقلها اويشحنها الطرف الاول 
                    ----
                    يلتزم الطرف الثانى بتقديم كافه الاوراق
                    والفواتير والتراخيص الخاصه بمزاوله نشاط التجاره الالكترونيه 
                    الخاصه بالمنتجات او الشحنات التى ينقلها
                    او يشحنها الطرف الاول عند طلبها للجهات الرسميه او الحكوميه 
                    ----
                    يلتزم الطرف الثانى ان يبين ما بداخل الشحنه من وصف وكميه ونوعها مع ارفاق 
                    الاوراق والفواتير بالمنتج المراد شحنه
                </p>
            </div>
            <footer>
                <SecButton class="sec-button" :width="'100%'"  @click="termsToggler = false;termsStatus=false">{{__('Reject')}}</SecButton>
                <MyButton class="basic-button" :width="'100%'"  @click="termsToggler = false;termsStatus=true" :label="__('Accept')"></MyButton>
            </footer>
        </div>
    </section>
      <Loading v-if="$genStore.state.loaderSwitch"></Loading>
      <header>
          <img :src="'/photos/logo.jpeg'" alt="Logo">
      </header>
      <div class="register-form">
          <header>
              <h2>{{__('Register')}}</h2>
              <p class="no-select" v-if="$genStore.getters.getLocale == 'ar'" @click="$genStore.commit('setLocale','en')" style="margin:0 0.8em;cursor:pointer;">En</p> 
              <p class="no-select" v-if="$genStore.getters.getLocale == 'en'" @click="$genStore.commit('setLocale','ar')" style="margin:0 0.8em;cursor:pointer;">ألعربية</p>
          </header>
          <div class="register-page-body">
            <Row>
                <MyInput  :label="__('First name')" v-model:object="user.f_name" />
                <MyInput  :label="__('Last name')" v-model:object="user.l_name" />
            </Row>
            <Row>
                <MyInput  :label="__('Mobile')" v-model:object="user.mobile" />
                <MyInput  :label="__('Second mobile')" :required="false" v-model:object="user.sec_mobile" />
            </Row>
            <Row>
                <Password  :label="__('Password')" v-model:object="user.password" />
                <Password  :label="__('Confirm password')" v-model:object="user.con_password" />
            </Row>
            <Row>
                <MyInput  :label="__('Email')" v-model:object="user.email" />
                <MySelect  :label="__('Payment method')" v-model:object="user.payment_method">
                    <option value='empty'>{{__('Select')}}</option>
                    <option value='Fawry'>Fawry</option>
                </MySelect>
            </Row>
            <Row>
                <MySelect  :label="__('Heard from')" v-model:object="user.heard_from">
                    <option value='empty'>{{__('Select')}}</option>
                    <option value='Facebook'>Facebook</option>
                    <option value='Friend'>Friend</option>
                </MySelect>
            </Row>
            <!-- LOCATION -->
            <h3 class="sub-title">{{__('Address')}}</h3>
            <Row>
                <MyInput  :label="__('City')" v-model:object="location.city" />
                <MyInput  :label="__('Area')" v-model:object="location.area" />
            </Row>
            <Row>
                    <MyInput :label="__('Street')" v-model:object="location.street" />
                    <MyInput :label="__('Landmarks')" v-model:object="location.landmarks"/>
            </Row>
            <Row>
                <MyInput  :label="__('Building')" v-model:object="location.building" :required="false"/>
                <MyInput  :label="__('Floor')"  v-model:object="location.floor" :required="false"/>
            </Row>
            <Row>
                <p class="terms-speech">
                    <span><input v-model="termsStatus" type="checkbox" @click.prevent="termsToggler = true"></span>
                    {{__('terms0')}} <span class="link" @click="termsToggler = true">{{__('terms1')}}</span>{{__('terms2')}}
                 </p>
            </Row>
            <Row>
                <MyButton @click="submit()" :notAllowed="!termsStatus" :width="'100%'" :label="__('Submit')"></MyButton>
            </Row>
          </div>
      </div>
      <footer>
          <p>{{__('1221')}} <span><a class="link" href="/login">{{__('Login')}}</a></span></p>
      </footer>
  </div>
</template>

<script>
export default {
    data(){
        return{
            termsStatus:false,
            termsToggler:false,
            logoSRC:'./public/photos/logo.png',
            user:{
                f_name:{value:null,err:null,name:'f_name'},
                l_name:{value:null,err:null,name:'l_name'},
                mobile:{value:null,err:null,name:'mobile'},
                password:{value:null,err:null,name:'password'},
                con_password:{value:null,err:null,name:'con_password'},
                sec_mobile:{value:null,err:null,name:'secmobile'},
                email:{value:null,err:null,name:'email'},
                payment_method:{value:'empty',err:null,name:'paymentmethod'},
                heard_from:{value:'empty',err:null,name:'heard_from'},
            },
            location:{
                city:{value:null,err:null,name:"city"},
                area:{value:null,err:null,name:"area"},
                landmarks:{value:null,err:null,name:"landmarks"},
                street:{value:null,err:null,name:"street"},
                building:{value:null,err:null,name:"building"},
                floor:{value:null,err:null,name:"floor"},
            }
        }
    },
    methods:{
        submit(){
            if(!this.termsStatus){return null;}
            if(!this.check()){return null;}
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/signup',
                data:{
                    user:this.User,
                    location:this.Location,
                }
            }).then(res => {
                if(res.data == 66){ this.user.email.err = this.__('E-mail is already taken');
                                    this.$genStore.commit('errorFound',this.user.mobile.name);
                                    return null;
                                }
                if(res.data == 77){ this.user.mobile.err = this.__('Mobile is already taken');
                                    this.$genStore.commit('errorFound',this.user.mobile.name);
                                    return null;
                                }
                if(res.data == 88){ this.user.sec_mobile.err = this.__('Mobile is already taken');
                                    this.$genStore.commit('errorFound',this.user.sec_mobile.name);
                                    return null;
                                }
                window.location.href = '/dashboard';
            }).catch(err => {
                console.log('Error found')
            }).then(() => {
                this.$genStore.commit('loading',false);
            })
        },
        check(){
            let User = this.user;
            let Location = this.location;
            if(!User.f_name.value || User.f_name.value.length < 3){
                User.f_name.err = this.__('Required');
                this.$genStore.commit('errorFound',User.f_name.name);
                return false;
            }else{User.f_name.err = null;}
            /* last name */
            if(!User.l_name.value || User.l_name.value.length < 3){
                User.l_name.err = this.__('Required');
                this.$genStore.commit('errorFound',User.l_name.name);
                return false;
            }else{User.l_name.err = null;}
            /* mobile */
            if(!User.mobile.value || User.mobile.value.length != 11){
                User.mobile.err = this.__('Mobile length is 11');
                this.$genStore.commit('errorFound',User.mobile.name);
                return false;
            }else{User.mobile.err = null;}
            /* password */
            if(!User.password.value || User.password.value.length < 8){
                User.password.err = this.__('Password can\'t be less than 8');
                this.$genStore.commit('errorFound',User.password.name);
                return false;
            }else{User.password.err = null;}
            /* conf password */
            if(!User.con_password||User.con_password.value != User.password.value){
                User.con_password.err = this.__('Not the same');
                this.$genStore.commit('errorFound',User.con_password.name);
                return false;
            }else{User.con_password.err = null;}
            /* email */
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            if(!re.test(User.email.value)){
                User.email.err = this.__('name@example.com');
                this.$genStore.commit('errorFound',User.email.name);
                return false;
            }else{User.email.err = null;}
            /* payment method */
            if(User.payment_method.value == 'empty'){
                User.payment_method.err = this.__('Select one !');
                this.$genStore.commit('errorFound',User.payment_method.name);
                return false;
            }else{User.payment_method.err = null;}
            /* heard_from */
            if(User.heard_from.value == 'empty'){
                User.heard_from.err = this.__('Select one !');
                this.$genStore.commit('errorFound',User.heard_from.name);
                return false;
            }else{User.heard_from.err = null;}
            /* city */
            if(!Location.city.value||Location.city.value.length < 3){
                Location.city.err = this.__('Required');
                this.$genStore.commit('errorFound',Location.city.name);
                return false;
            }else{Location.city.err = null;}
            /* area */
            if(!Location.area.value||Location.area.value.length < 3){
                Location.area.err = this.__('Required');
                this.$genStore.commit('errorFound',Location.area.name);
                return false;
            }else{Location.area.err = null;}
            /* street */
            if(!Location.street.value||Location.street.value.length < 3){
                Location.street.err = this.__('Required');
                this.$genStore.commit('errorFound',Location.street.name);
                return false;
            }else{Location.street.err = null;}
            /* landmarks */
            if(!Location.landmarks.value||Location.landmarks.value.length < 5){
                Location.landmarks.err = this.__('Required');
                this.$genStore.commit('errorFound',Location.landmarks.name);
                return false;
            }else{Location.landmarks.err = null;}


            return true;
        }
    },
    computed:{
        User:function(){
            let user = {};
            for (const key in this.user) {
                    user[key] = this.user[key].value;
            }
            return user;
        },
        Location:function(){
            let location = {};
            for (const key in this.location) {
                    location[key] = this.location[key].value;
            }
            return location;
        },
    }
}
</script>

<style lang='scss' scoped> 
.register-page{
    overflow:auto;
    height:100vh;
    width:100vw;
    display:flex;  align-items:center;
    flex-direction:column;
    background-color:#2c3e50;
    &>header{
        padding-top:1em;
        img{
            margin-top:1em;
            height:6em;
        }
    }
    .register-form{
        display:flex; flex-direction:column;
        width:60%;
        min-width:88%;
        header{
            padding:0.4em 1em;
            box-shadow:0 1px 1px 0 #eee;
            p{
                float: inline-end;
            }
        }
        box-shadow:0 0 3px 0 #aaa ;
        background-color:rgba($color: #ddd, $alpha: 0.9);
        .register-page-body{
            scroll-behavior: smooth;
            padding:1em 1em;
            flex:1;
            overflow:auto;
            .sub-title{
                text-align:center;
                padding:0.6em;
                border-top:1px solid #eee;
                border-bottom:1px solid #eee;
            }
            .terms-speech{
                width: 100%;
                font-size:0.8em;
                color:rgb(65, 62, 62);
                display:inline;
            }
        }
    }
    &>footer{
        margin: 0.4em 0.2em 0.6em;
        color:#fff;
    }
}
.terms{
    position:fixed; text-align:center;
    inset:0;        z-index:10;
    background-color:rgba(76, 75, 75, 0.5);
    display:flex;   justify-content: center;       align-items:center;
    &>div{
        height:90vh;
        background-color:#fff;  border-radius:0.5em;
        padding:0.3em 0.5em;      width:max-content;
        overflow: none;         display:flex;
        flex-direction:column;
        max-width:60vw;
        header{
            padding:0.4em 0.5em;
            font-size:0.7em;
        }
        &>div{
            overflow:auto;
            text-align:right;
            margin:0.4em 0.7em;
            border: 1px solid #999;
            border-radius:0.4em;
            flex:1;
            padding:0.7em 1em;
            font-size:0.6em;
            box-shadow:inset 0 0 2px 0px rgba(90, 87, 87, 0.8); 
        }
        footer{
            padding:0.4em 0.3em;
            display:flex;
            button{
                flex:1;
                margin:0.3em 0.4em;
            }
        }
    }
}
</style>