<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        // FAQ Categories and Questions
        $faqCategories = [
            'accounts' => [
                'fr' => 'Comptes & Cartes',
                'de' => 'Konten & Karten',
                'en' => 'Accounts & Cards',
                'es' => 'Cuentas y Tarjetas'
            ],
            'credits' => [
                'fr' => 'Crédits & Prêts',
                'de' => 'Kredite & Darlehen',
                'en' => 'Credits & Loans',
                'es' => 'Créditos y Préstamos'
            ],
            'security' => [
                'fr' => 'Sécurité',
                'de' => 'Sicherheit',
                'en' => 'Security',
                'es' => 'Seguridad'
            ],
            'services' => [
                'fr' => 'Services en ligne',
                'de' => 'Online-Dienste',
                'en' => 'Online Services',
                'es' => 'Servicios en línea'
            ],
            'general' => [
                'fr' => 'Questions générales',
                'de' => 'Allgemeine Fragen',
                'en' => 'General Questions',
                'es' => 'Preguntas generales'
            ],
        ];

        $faqs = [
            'accounts' => [
                [
                    'question' => [
                        'fr' => 'Comment ouvrir un compte chez Acrevis Bank ?',
                        'de' => 'Wie eröffne ich ein Konto bei der Acrevis Bank?',
                        'en' => 'How do I open an account at Acrevis Bank?',
                        'es' => '¿Cómo abro una cuenta en Acrevis Bank?'
                    ],
                    'answer' => [
                        'fr' => 'L\'ouverture d\'un compte est simple et rapide. Cliquez sur "Créer un compte" en haut de la page, remplissez le formulaire en ligne avec vos informations personnelles, téléchargez une pièce d\'identité valide (passeport ou carte d\'identité), et notre équipe validera votre demande sous 24-48 heures. Une fois validé, vous recevrez vos identifiants d\'accès par email sécurisé.',
                        'de' => 'Die Kontoeröffnung ist einfach und schnell. Klicken Sie oben auf der Seite auf "Konto erstellen", füllen Sie das Online-Formular mit Ihren persönlichen Daten aus, laden Sie einen gültigen Ausweis (Reisepass oder Personalausweis) hoch, und unser Team wird Ihren Antrag innerhalb von 24-48 Stunden validieren. Nach der Validierung erhalten Sie Ihre Zugangsdaten per sicherer E-Mail.',
                        'en' => 'Opening an account is simple and quick. Click on "Create account" at the top of the page, fill out the online form with your personal information, upload a valid ID (passport or identity card), and our team will validate your request within 24-48 hours. Once validated, you will receive your access credentials via secure email.',
                        'es' => 'Abrir una cuenta es simple y rápido. Haga clic en "Crear cuenta" en la parte superior de la página, complete el formulario en línea con su información personal, cargue una identificación válida (pasaporte o tarjeta de identidad), y nuestro equipo validará su solicitud en 24-48 horas. Una vez validado, recibirá sus credenciales de acceso por correo electrónico seguro.'
                    ]
                ],
                [
                    'question' => [
                        'fr' => 'Quels sont les frais de tenue de compte ?',
                        'de' => 'Welche Kontoführungsgebühren fallen an?',
                        'en' => 'What are the account maintenance fees?',
                        'es' => '¿Cuáles son las tarifas de mantenimiento de cuenta?'
                    ],
                    'answer' => [
                        'fr' => 'Nos frais de tenue de compte sont compétitifs et transparents. Pour un compte courant privé standard, les frais sont de CHF 5.- par mois. Les jeunes de moins de 25 ans et les étudiants bénéficient de la gratuité. Pour les comptes épargne, aucun frais de tenue n\'est appliqué. Consultez notre grille tarifaire complète dans votre espace client ou contactez-nous pour plus d\'informations.',
                        'de' => 'Unsere Kontoführungsgebühren sind wettbewerbsfähig und transparent. Für ein privates Standardkonto betragen die Gebühren CHF 5.- pro Monat. Junge Menschen unter 25 Jahren und Studenten profitieren von der Kostenfreiheit. Für Sparkonten werden keine Kontoführungsgebühren erhoben. Konsultieren Sie unsere vollständige Gebührenübersicht in Ihrem Kundenbereich oder kontaktieren Sie uns für weitere Informationen.',
                        'en' => 'Our account maintenance fees are competitive and transparent. For a standard private current account, the fees are CHF 5.- per month. Young people under 25 and students benefit from free service. For savings accounts, no maintenance fees are applied. Consult our complete fee schedule in your customer area or contact us for more information.',
                        'es' => 'Nuestras tarifas de mantenimiento de cuenta son competitivas y transparentes. Para una cuenta corriente privada estándar, las tarifas son de CHF 5.- por mes. Los jóvenes menores de 25 años y los estudiantes se benefician del servicio gratuito. Para las cuentas de ahorro, no se aplican tarifas de mantenimiento. Consulte nuestra tabla de tarifas completa en su área de cliente o contáctenos para obtener más información.'
                    ]
                ],
                [
                    'question' => [
                        'fr' => 'Comment commander une nouvelle carte bancaire ?',
                        'de' => 'Wie bestelle ich eine neue Bankkarte?',
                        'en' => 'How do I order a new bank card?',
                        'es' => '¿Cómo pido una nueva tarjeta bancaria?'
                    ],
                    'answer' => [
                        'fr' => 'Pour commander une nouvelle carte, connectez-vous à votre espace client, accédez à la section "Cartes" dans le menu, puis cliquez sur "Commander une carte". Choisissez le type de carte souhaité (Maestro, Visa Débit, ou Visa Credit), confirmez vos informations de livraison, et validez votre commande. Vous recevrez votre nouvelle carte sous 5-7 jours ouvrables à votre domicile, avec le code PIN envoyé séparément pour plus de sécurité.',
                        'de' => 'Um eine neue Karte zu bestellen, melden Sie sich in Ihrem Kundenbereich an, gehen Sie zum Abschnitt "Karten" im Menü und klicken Sie dann auf "Karte bestellen". Wählen Sie die gewünschte Kartenart (Maestro, Visa Debit oder Visa Credit), bestätigen Sie Ihre Lieferinformationen und validieren Sie Ihre Bestellung. Sie erhalten Ihre neue Karte innerhalb von 5-7 Werktagen zu Hause, mit dem PIN-Code separat gesendet für mehr Sicherheit.',
                        'en' => 'To order a new card, log in to your customer area, go to the "Cards" section in the menu, then click on "Order a card". Choose the desired card type (Maestro, Visa Debit, or Visa Credit), confirm your delivery information, and validate your order. You will receive your new card within 5-7 business days at home, with the PIN code sent separately for added security.',
                        'es' => 'Para pedir una nueva tarjeta, inicie sesión en su área de cliente, vaya a la sección "Tarjetas" en el menú, luego haga clic en "Pedir una tarjeta". Elija el tipo de tarjeta deseado (Maestro, Visa Débito o Visa Crédito), confirme su información de entrega y valide su pedido. Recibirá su nueva tarjeta en 5-7 días hábiles en su hogar, con el código PIN enviado por separado para mayor seguridad.'
                    ]
                ],
            ],
            'credits' => [
                [
                    'question' => [
                        'fr' => 'Quelles sont les conditions pour obtenir un crédit ?',
                        'de' => 'Welche Voraussetzungen gelten für einen Kredit?',
                        'en' => 'What are the conditions to obtain a credit?',
                        'es' => '¿Cuáles son las condiciones para obtener un crédito?'
                    ],
                    'answer' => [
                        'fr' => 'Pour obtenir un crédit chez Acrevis Bank, vous devez : être majeur (18 ans minimum), résider en Suisse, disposer d\'un revenu régulier et stable, ne pas être en situation de surendettement, et fournir les documents justificatifs (pièce d\'identité, bulletins de salaire des 3 derniers mois, avis d\'imposition). Le montant accordé dépendra de votre capacité de remboursement évaluée selon les normes bancaires suisses.',
                        'de' => 'Um einen Kredit bei der Acrevis Bank zu erhalten, müssen Sie: volljährig sein (mindestens 18 Jahre alt), in der Schweiz wohnhaft sein, über ein regelmäßiges und stabiles Einkommen verfügen, nicht überschuldet sein und die erforderlichen Unterlagen vorlegen (Ausweis, Lohnabrechnungen der letzten 3 Monate, Steuerbescheid). Der bewilligte Betrag hängt von Ihrer Rückzahlungsfähigkeit ab, die nach Schweizer Bankenstandards bewertet wird.',
                        'en' => 'To obtain a credit at Acrevis Bank, you must: be of legal age (minimum 18 years), reside in Switzerland, have a regular and stable income, not be in a situation of over-indebtedness, and provide supporting documents (identity card, salary statements for the last 3 months, tax notice). The amount granted will depend on your repayment capacity assessed according to Swiss banking standards.',
                        'es' => 'Para obtener un crédito en Acrevis Bank, debe: ser mayor de edad (mínimo 18 años), residir en Suiza, tener un ingreso regular y estable, no estar en situación de sobreendeudamiento, y proporcionar documentos justificativos (documento de identidad, recibos de sueldo de los últimos 3 meses, aviso de impuestos). El monto otorgado dependerá de su capacidad de pago evaluada según los estándares bancarios suizos.'
                    ]
                ],
                [
                    'question' => [
                        'fr' => 'Quel est le délai de traitement d\'une demande de crédit ?',
                        'de' => 'Wie lange dauert die Bearbeitung eines Kreditantrags?',
                        'en' => 'What is the processing time for a credit request?',
                        'es' => '¿Cuál es el tiempo de procesamiento de una solicitud de crédito?'
                    ],
                    'answer' => [
                        'fr' => 'Nous nous engageons à traiter votre demande de crédit rapidement. En général, vous recevrez une réponse de principe sous 24 à 48 heures après réception de votre dossier complet. Pour les montants plus importants ou les dossiers nécessitant une analyse approfondie, le délai peut s\'étendre à 5 jours ouvrables. Une fois votre crédit approuvé, les fonds sont généralement versés sur votre compte dans les 2-3 jours ouvrables.',
                        'de' => 'Wir verpflichten uns, Ihren Kreditantrag schnell zu bearbeiten. In der Regel erhalten Sie innerhalb von 24 bis 48 Stunden nach Erhalt Ihrer vollständigen Unterlagen eine grundsätzliche Antwort. Für höhere Beträge oder Anträge, die eine eingehende Analyse erfordern, kann die Frist auf 5 Werktage verlängert werden. Sobald Ihr Kredit genehmigt ist, werden die Mittel in der Regel innerhalb von 2-3 Werktagen auf Ihr Konto überwiesen.',
                        'en' => 'We are committed to processing your credit request quickly. Generally, you will receive a preliminary response within 24 to 48 hours after receiving your complete file. For larger amounts or files requiring in-depth analysis, the deadline may be extended to 5 business days. Once your credit is approved, the funds are usually transferred to your account within 2-3 business days.',
                        'es' => 'Nos comprometemos a procesar su solicitud de crédito rápidamente. En general, recibirá una respuesta preliminar dentro de 24 a 48 horas después de recibir su expediente completo. Para montos mayores o expedientes que requieren un análisis en profundidad, el plazo puede extenderse a 5 días hábiles. Una vez que su crédito sea aprobado, los fondos generalmente se transfieren a su cuenta dentro de 2-3 días hábiles.'
                    ]
                ],
                [
                    'question' => [
                        'fr' => 'Puis-je rembourser mon crédit par anticipation ?',
                        'de' => 'Kann ich meinen Kredit vorzeitig zurückzahlen?',
                        'en' => 'Can I repay my credit early?',
                        'es' => '¿Puedo pagar mi crédito por anticipado?'
                    ],
                    'answer' => [
                        'fr' => 'Oui, vous pouvez rembourser votre crédit par anticipation à tout moment, en totalité ou partiellement. Nous appliquons des conditions avantageuses pour les remboursements anticipés. Pour un remboursement total anticipé, une indemnité maximale de 1% du capital restant dû est facturée. Pour un remboursement partiel, les frais sont calculés au prorata. Contactez votre conseiller pour obtenir un décompte précis avant de procéder au remboursement.',
                        'de' => 'Ja, Sie können Ihren Kredit jederzeit vorzeitig zurückzahlen, ganz oder teilweise. Wir wenden vorteilhafte Bedingungen für vorzeitige Rückzahlungen an. Bei vollständiger vorzeitiger Rückzahlung wird eine maximale Entschädigung von 1% des verbleibenden Kapitals berechnet. Bei teilweiser Rückzahlung werden die Gebühren anteilig berechnet. Kontaktieren Sie Ihren Berater, um vor der Rückzahlung eine genaue Abrechnung zu erhalten.',
                        'en' => 'Yes, you can repay your credit early at any time, in full or partially. We apply advantageous conditions for early repayments. For full early repayment, a maximum penalty of 1% of the remaining capital is charged. For partial repayment, fees are calculated proportionally. Contact your advisor to obtain an accurate statement before proceeding with the repayment.',
                        'es' => 'Sí, puede pagar su crédito por anticipado en cualquier momento, total o parcialmente. Aplicamos condiciones ventajosas para pagos anticipados. Para un pago anticipado total, se cobra una indemnización máxima del 1% del capital restante. Para un pago parcial, las tarifas se calculan proporcionalmente. Contacte a su asesor para obtener un estado de cuenta preciso antes de proceder con el pago.'
                    ]
                ],
            ],
            'security' => [
                [
                    'question' => [
                        'fr' => 'Comment est sécurisé mon accès à l\'espace client ?',
                        'de' => 'Wie ist mein Zugang zum Kundenbereich gesichert?',
                        'en' => 'How is my access to the customer area secured?',
                        'es' => '¿Cómo está asegurado mi acceso al área de cliente?'
                    ],
                    'answer' => [
                        'fr' => 'Votre sécurité est notre priorité. Nous utilisons une authentification à deux facteurs (2FA) obligatoire pour tous les accès à l\'espace client. Après avoir saisi votre identifiant et mot de passe, vous devez confirmer votre identité via un code SMS ou une application d\'authentification (Google Authenticator, Authy). Toutes les communications sont chiffrées avec le protocole SSL/TLS. De plus, nous surveillons en permanence les activités suspectes et vous alertons en cas de connexion depuis un nouvel appareil.',
                        'de' => 'Ihre Sicherheit hat für uns Priorität. Wir verwenden eine obligatorische Zwei-Faktor-Authentifizierung (2FA) für alle Zugriffe auf den Kundenbereich. Nachdem Sie Ihre Kennung und Ihr Passwort eingegeben haben, müssen Sie Ihre Identität über einen SMS-Code oder eine Authentifizierungs-App (Google Authenticator, Authy) bestätigen. Alle Kommunikationen sind mit dem SSL/TLS-Protokoll verschlüsselt. Darüber hinaus überwachen wir ständig verdächtige Aktivitäten und warnen Sie bei Verbindungen von einem neuen Gerät.',
                        'en' => 'Your security is our priority. We use mandatory two-factor authentication (2FA) for all access to the customer area. After entering your username and password, you must confirm your identity via an SMS code or an authentication app (Google Authenticator, Authy). All communications are encrypted with the SSL/TLS protocol. Additionally, we constantly monitor suspicious activities and alert you in case of connection from a new device.',
                        'es' => 'Su seguridad es nuestra prioridad. Utilizamos autenticación de dos factores (2FA) obligatoria para todos los accesos al área de cliente. Después de ingresar su identificación y contraseña, debe confirmar su identidad a través de un código SMS o una aplicación de autenticación (Google Authenticator, Authy). Todas las comunicaciones están cifradas con el protocolo SSL/TLS. Además, monitoreamos constantemente actividades sospechosas y lo alertamos en caso de conexión desde un nuevo dispositivo.'
                    ]
                ],
                [
                    'question' => [
                        'fr' => 'Que faire si je perds ma carte bancaire ?',
                        'de' => 'Was soll ich tun, wenn ich meine Bankkarte verliere?',
                        'en' => 'What should I do if I lose my bank card?',
                        'es' => '¿Qué debo hacer si pierdo mi tarjeta bancaria?'
                    ],
                    'answer' => [
                        'fr' => 'En cas de perte ou vol de votre carte bancaire, agissez immédiatement : 1) Bloquez votre carte via votre espace client (section "Cartes" > "Bloquer ma carte") ou appelez notre service client 24/7 au +41 71 123 45 67. 2) Déposez plainte auprès de la police si votre carte a été volée. 3) Commandez une nouvelle carte dans votre espace client. Le blocage est effectif immédiatement et vous n\'êtes pas responsable des transactions frauduleuses effectuées après le blocage.',
                        'de' => 'Im Falle eines Verlusts oder Diebstahls Ihrer Bankkarte handeln Sie sofort: 1) Sperren Sie Ihre Karte über Ihren Kundenbereich (Abschnitt "Karten" > "Karte sperren") oder rufen Sie unseren 24/7-Kundenservice unter +41 71 123 45 67 an. 2) Erstatten Sie Anzeige bei der Polizei, wenn Ihre Karte gestohlen wurde. 3) Bestellen Sie eine neue Karte in Ihrem Kundenbereich. Die Sperrung ist sofort wirksam und Sie sind nicht für betrügerische Transaktionen verantwortlich, die nach der Sperrung durchgeführt wurden.',
                        'en' => 'In case of loss or theft of your bank card, act immediately: 1) Block your card via your customer area (section "Cards" > "Block my card") or call our 24/7 customer service at +41 71 123 45 67. 2) File a complaint with the police if your card has been stolen. 3) Order a new card in your customer area. The blocking is effective immediately and you are not responsible for fraudulent transactions made after the blocking.',
                        'es' => 'En caso de pérdida o robo de su tarjeta bancaria, actúe inmediatamente: 1) Bloquee su tarjeta a través de su área de cliente (sección "Tarjetas" > "Bloquear mi tarjeta") o llame a nuestro servicio al cliente 24/7 al +41 71 123 45 67. 2) Presente una denuncia ante la policía si su tarjeta ha sido robada. 3) Pida una nueva tarjeta en su área de cliente. El bloqueo es efectivo inmediatamente y usted no es responsable de transacciones fraudulentas realizadas después del bloqueo.'
                    ]
                ],
                [
                    'question' => [
                        'fr' => 'Comment Acrevis Bank protège-t-elle mes données personnelles ?',
                        'de' => 'Wie schützt die Acrevis Bank meine persönlichen Daten?',
                        'en' => 'How does Acrevis Bank protect my personal data?',
                        'es' => '¿Cómo protege Acrevis Bank mis datos personales?'
                    ],
                    'answer' => [
                        'fr' => 'Nous prenons la protection de vos données très au sérieux et appliquons les normes les plus strictes : Conformité totale au RGPD et à la Loi fédérale suisse sur la protection des données (LPD). Vos données sont stockées sur des serveurs sécurisés en Suisse, chiffrées au repos et en transit. Nous n\'utilisons jamais vos données personnelles à des fins commerciales sans votre consentement explicite. Accès aux données strictement limité au personnel autorisé. Audits de sécurité réguliers par des organismes indépendants.',
                        'de' => 'Wir nehmen den Schutz Ihrer Daten sehr ernst und wenden die strengsten Standards an: Vollständige Einhaltung der DSGVO und des Schweizer Bundesgesetzes über den Datenschutz (DSG). Ihre Daten werden auf sicheren Servern in der Schweiz gespeichert, verschlüsselt im Ruhezustand und während der Übertragung. Wir verwenden Ihre persönlichen Daten niemals für kommerzielle Zwecke ohne Ihre ausdrückliche Zustimmung. Zugriff auf Daten streng auf autorisiertes Personal beschränkt. Regelmäßige Sicherheitsaudits durch unabhängige Organisationen.',
                        'en' => 'We take the protection of your data very seriously and apply the strictest standards: Full compliance with GDPR and the Swiss Federal Data Protection Act (FDPA). Your data is stored on secure servers in Switzerland, encrypted at rest and in transit. We never use your personal data for commercial purposes without your explicit consent. Access to data strictly limited to authorized personnel. Regular security audits by independent organizations.',
                        'es' => 'Tomamos muy en serio la protección de sus datos y aplicamos los estándares más estrictos: Cumplimiento total del RGPD y la Ley Federal Suiza de Protección de Datos (LPD). Sus datos se almacenan en servidores seguros en Suiza, cifrados en reposo y en tránsito. Nunca utilizamos sus datos personales con fines comerciales sin su consentimiento explícito. Acceso a datos estrictamente limitado al personal autorizado. Auditorías de seguridad regulares por organizaciones independientes.'
                    ]
                ],
            ],
            'services' => [
                [
                    'question' => [
                        'fr' => 'Comment effectuer un virement depuis mon espace client ?',
                        'de' => 'Wie tätige ich eine Überweisung von meinem Kundenbereich aus?',
                        'en' => 'How do I make a transfer from my customer area?',
                        'es' => '¿Cómo realizo una transferencia desde mi área de cliente?'
                    ],
                    'answer' => [
                        'fr' => 'Effectuer un virement est simple : 1) Connectez-vous à votre espace client. 2) Cliquez sur "Nouveau virement" dans le menu. 3) Sélectionnez le compte débiteur. 4) Indiquez le bénéficiaire (IBAN) et le montant. 5) Vérifiez les informations et confirmez. 6) Validez la transaction avec votre code 2FA. Les virements nationaux sont traités le jour même si effectués avant 15h, les virements internationaux sous 1-3 jours ouvrables.',
                        'de' => 'Eine Überweisung durchzuführen ist einfach: 1) Melden Sie sich in Ihrem Kundenbereich an. 2) Klicken Sie im Menü auf "Neue Überweisung". 3) Wählen Sie das Belastungskonto aus. 4) Geben Sie den Begünstigten (IBAN) und den Betrag an. 5) Überprüfen Sie die Informationen und bestätigen Sie. 6) Validieren Sie die Transaktion mit Ihrem 2FA-Code. Inlandsüberweisungen werden am selben Tag bearbeitet, wenn sie vor 15 Uhr durchgeführt werden, Auslandsüberweisungen innerhalb von 1-3 Werktagen.',
                        'en' => 'Making a transfer is simple: 1) Log in to your customer area. 2) Click on "New transfer" in the menu. 3) Select the debit account. 4) Indicate the beneficiary (IBAN) and amount. 5) Check the information and confirm. 6) Validate the transaction with your 2FA code. Domestic transfers are processed the same day if made before 3 PM, international transfers within 1-3 business days.',
                        'es' => 'Realizar una transferencia es simple: 1) Inicie sesión en su área de cliente. 2) Haga clic en "Nueva transferencia" en el menú. 3) Seleccione la cuenta de débito. 4) Indique el beneficiario (IBAN) y el monto. 5) Verifique la información y confirme. 6) Valide la transacción con su código 2FA. Las transferencias nacionales se procesan el mismo día si se realizan antes de las 15h, las transferencias internacionales dentro de 1-3 días hábiles.'
                    ]
                ],
                [
                    'question' => [
                        'fr' => 'Puis-je consulter mes comptes sur mobile ?',
                        'de' => 'Kann ich meine Konten auf dem Handy einsehen?',
                        'en' => 'Can I view my accounts on mobile?',
                        'es' => '¿Puedo consultar mis cuentas en el móvil?'
                    ],
                    'answer' => [
                        'fr' => 'Oui, notre plateforme e-banking est entièrement responsive et optimisée pour les appareils mobiles. Vous pouvez accéder à tous vos comptes, effectuer des virements, consulter vos transactions et gérer vos cartes directement depuis votre smartphone ou tablette via votre navigateur web. Nous travaillons également sur une application mobile dédiée qui sera disponible prochainement sur iOS et Android pour une expérience encore plus fluide.',
                        'de' => 'Ja, unsere E-Banking-Plattform ist vollständig responsiv und für mobile Geräte optimiert. Sie können alle Ihre Konten einsehen, Überweisungen tätigen, Ihre Transaktionen einsehen und Ihre Karten direkt von Ihrem Smartphone oder Tablet über Ihren Webbrowser verwalten. Wir arbeiten auch an einer dedizierten mobilen App, die bald für iOS und Android verfügbar sein wird, für ein noch flüssigeres Erlebnis.',
                        'en' => 'Yes, our e-banking platform is fully responsive and optimized for mobile devices. You can access all your accounts, make transfers, view your transactions and manage your cards directly from your smartphone or tablet via your web browser. We are also working on a dedicated mobile app that will be available soon on iOS and Android for an even smoother experience.',
                        'es' => 'Sí, nuestra plataforma de e-banking es completamente responsive y está optimizada para dispositivos móviles. Puede acceder a todas sus cuentas, realizar transferencias, consultar sus transacciones y administrar sus tarjetas directamente desde su smartphone o tablet a través de su navegador web. También estamos trabajando en una aplicación móvil dedicada que estará disponible pronto en iOS y Android para una experiencia aún más fluida.'
                    ]
                ],
            ],
            'general' => [
                [
                    'question' => [
                        'fr' => 'Comment contacter le service client ?',
                        'de' => 'Wie kontaktiere ich den Kundenservice?',
                        'en' => 'How do I contact customer service?',
                        'es' => '¿Cómo contacto con el servicio al cliente?'
                    ],
                    'answer' => [
                        'fr' => 'Notre service client est à votre disposition via plusieurs canaux : Par téléphone : +41 71 123 45 67 (du lundi au vendredi, 8h-18h). Urgences 24/7 : +41 71 123 45 99. Par email : support@acrevisbank.ch (réponse sous 24h). Via le formulaire de contact sur notre site. En agence : consultez nos horaires sur la page "Nos agences". Pour les questions simples, notre chat en ligne est disponible du lundi au vendredi de 9h à 17h.',
                        'de' => 'Unser Kundenservice steht Ihnen über mehrere Kanäle zur Verfügung: Telefonisch: +41 71 123 45 67 (Montag bis Freitag, 8-18 Uhr). Notfälle 24/7: +41 71 123 45 99. Per E-Mail: support@acrevisbank.ch (Antwort innerhalb von 24 Stunden). Über das Kontaktformular auf unserer Website. In der Filiale: Siehe unsere Öffnungszeiten auf der Seite "Unsere Filialen". Für einfache Fragen steht unser Online-Chat montags bis freitags von 9 bis 17 Uhr zur Verfügung.',
                        'en' => 'Our customer service is available to you through several channels: By phone: +41 71 123 45 67 (Monday to Friday, 8am-6pm). 24/7 emergencies: +41 71 123 45 99. By email: support@acrevisbank.ch (response within 24h). Via the contact form on our site. At the branch: check our hours on the "Our branches" page. For simple questions, our online chat is available Monday to Friday from 9am to 5pm.',
                        'es' => 'Nuestro servicio al cliente está a su disposición a través de varios canales: Por teléfono: +41 71 123 45 67 (lunes a viernes, 8h-18h). Emergencias 24/7: +41 71 123 45 99. Por correo electrónico: support@acrevisbank.ch (respuesta en 24h). A través del formulario de contacto en nuestro sitio. En la agencia: consulte nuestros horarios en la página "Nuestras agencias". Para preguntas simples, nuestro chat en línea está disponible de lunes a viernes de 9h a 17h.'
                    ]
                ],
                [
                    'question' => [
                        'fr' => 'Où puis-je trouver les horaires d\'ouverture des agences ?',
                        'de' => 'Wo finde ich die Öffnungszeiten der Filialen?',
                        'en' => 'Where can I find the branch opening hours?',
                        'es' => '¿Dónde puedo encontrar los horarios de apertura de las agencias?'
                    ],
                    'answer' => [
                        'fr' => 'Les horaires d\'ouverture de toutes nos agences sont disponibles sur la page "Nos agences" accessible depuis le menu principal du site. Vous y trouverez pour chaque agence : les horaires d\'ouverture détaillés, l\'adresse complète avec plan d\'accès, le numéro de téléphone direct, et les services disponibles. La plupart de nos agences sont ouvertes du lundi au vendredi de 8h30 à 17h30. Certaines agences offrent également un service le samedi matin.',
                        'de' => 'Die Öffnungszeiten aller unserer Filialen sind auf der Seite "Unsere Filialen" verfügbar, die über das Hauptmenü der Website zugänglich ist. Sie finden dort für jede Filiale: detaillierte Öffnungszeiten, vollständige Adresse mit Anfahrtsplan, direkte Telefonnummer und verfügbare Dienstleistungen. Die meisten unserer Filialen sind montags bis freitags von 8:30 bis 17:30 Uhr geöffnet. Einige Filialen bieten auch samstags vormittags einen Service an.',
                        'en' => 'The opening hours of all our branches are available on the "Our branches" page accessible from the main menu of the site. You will find for each branch: detailed opening hours, full address with access map, direct telephone number, and available services. Most of our branches are open Monday to Friday from 8:30 AM to 5:30 PM. Some branches also offer service on Saturday morning.',
                        'es' => 'Los horarios de apertura de todas nuestras agencias están disponibles en la página "Nuestras agencias" accesible desde el menú principal del sitio. Encontrará para cada agencia: horarios de apertura detallados, dirección completa con mapa de acceso, número de teléfono directo y servicios disponibles. La mayoría de nuestras agencias están abiertas de lunes a viernes de 8:30 a 17:30. Algunas agencias también ofrecen servicio los sábados por la mañana.'
                    ]
                ],
                [
                    'question' => [
                        'fr' => 'Acrevis Bank propose-t-elle des services pour les entreprises ?',
                        'de' => 'Bietet die Acrevis Bank Dienstleistungen für Unternehmen an?',
                        'en' => 'Does Acrevis Bank offer services for businesses?',
                        'es' => '¿Acrevis Bank ofrece servicios para empresas?'
                    ],
                    'answer' => [
                        'fr' => 'Oui, nous proposons une gamme complète de services bancaires pour les entreprises, PME et indépendants : Comptes professionnels avec tarifs adaptés, Solutions de paiement (TPE, paiement en ligne), Crédits professionnels et lignes de crédit, Financement de projets et investissements, Gestion de trésorerie, Services de change et commerce international. Pour en savoir plus sur nos offres entreprises, contactez notre département Business Banking au +41 71 123 45 80 ou via business@acrevisbank.ch.',
                        'de' => 'Ja, wir bieten ein umfassendes Angebot an Bankdienstleistungen für Unternehmen, KMU und Selbstständige: Geschäftskonten mit angepassten Tarifen, Zahlungslösungen (POS, Online-Zahlung), Geschäftskredite und Kreditlinien, Projekt- und Investitionsfinanzierung, Liquiditätsmanagement, Wechsel- und internationaler Handelsdienste. Um mehr über unsere Unternehmensangebote zu erfahren, kontaktieren Sie unsere Business Banking-Abteilung unter +41 71 123 45 80 oder über business@acrevisbank.ch.',
                        'en' => 'Yes, we offer a complete range of banking services for businesses, SMEs and self-employed: Professional accounts with adapted rates, Payment solutions (POS, online payment), Business credits and credit lines, Project and investment financing, Treasury management, Exchange and international trade services. To learn more about our business offers, contact our Business Banking department at +41 71 123 45 80 or via business@acrevisbank.ch.',
                        'es' => 'Sí, ofrecemos una gama completa de servicios bancarios para empresas, PYMES e independientes: Cuentas profesionales con tarifas adaptadas, Soluciones de pago (TPV, pago en línea), Créditos profesionales y líneas de crédito, Financiación de proyectos e inversiones, Gestión de tesorería, Servicios de cambio y comercio internacional. Para obtener más información sobre nuestras ofertas para empresas, contacte a nuestro departamento de Business Banking al +41 71 123 45 80 o a través de business@acrevisbank.ch.'
                    ]
                ],
            ],
        ];
    @endphp

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-900 via-slate-900 to-blue-950 py-20 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="faq-grid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#faq-grid)" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-2xl mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    @if($currentLocale === 'fr')
                        Foire Aux Questions
                    @elseif($currentLocale === 'de')
                        Häufig Gestellte Fragen
                    @elseif($currentLocale === 'en')
                        Frequently Asked Questions
                    @else
                        Preguntas Frecuentes
                    @endif
                </h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    @if($currentLocale === 'fr')
                        Trouvez rapidement des réponses à vos questions sur nos services bancaires, crédits, sécurité et bien plus encore.
                    @elseif($currentLocale === 'de')
                        Finden Sie schnell Antworten auf Ihre Fragen zu unseren Bankdienstleistungen, Krediten, Sicherheit und vielem mehr.
                    @elseif($currentLocale === 'en')
                        Quickly find answers to your questions about our banking services, credits, security and much more.
                    @else
                        Encuentre rápidamente respuestas a sus preguntas sobre nuestros servicios bancarios, créditos, seguridad y mucho más.
                    @endif
                </p>
            </div>
        </div>
    </section>

    <!-- FAQ Content -->
    <section class="py-16 bg-slate-50" x-data="{
        searchQuery: '',
        selectedCategory: 'all',
        openFaq: null,
        get filteredFaqs() {
            const allFaqs = {{ Js::from($faqs) }};
            let result = {};

            for (const category in allFaqs) {
                const categoryFaqs = allFaqs[category].filter(faq => {
                    const matchesSearch = !this.searchQuery ||
                        faq.question['{{ $currentLocale }}'].toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        faq.answer['{{ $currentLocale }}'].toLowerCase().includes(this.searchQuery.toLowerCase());
                    const matchesCategory = this.selectedCategory === 'all' || this.selectedCategory === category;
                    return matchesSearch && matchesCategory;
                });

                if (categoryFaqs.length > 0) {
                    result[category] = categoryFaqs;
                }
            }

            return result;
        }
    }">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <div class="mb-10">
                <div class="relative">
                    <input type="text"
                           x-model="searchQuery"
                           placeholder="{{ $currentLocale === 'fr' ? 'Rechercher une question...' : ($currentLocale === 'de' ? 'Eine Frage suchen...' : ($currentLocale === 'en' ? 'Search a question...' : 'Buscar una pregunta...')) }}"
                           class="w-full px-6 py-4 pl-14 bg-white border-2 border-slate-200 rounded-xl text-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
                    <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Category Filters -->
            <div class="flex flex-wrap gap-3 mb-12">
                <button @click="selectedCategory = 'all'; openFaq = null"
                        :class="selectedCategory === 'all' ? 'bg-blue-600 text-white' : 'bg-white text-slate-700 hover:bg-slate-100'"
                        class="px-6 py-2.5 rounded-lg font-medium transition-all shadow-sm border border-slate-200">
                    @if($currentLocale === 'fr')
                        Toutes
                    @elseif($currentLocale === 'de')
                        Alle
                    @elseif($currentLocale === 'en')
                        All
                    @else
                        Todas
                    @endif
                </button>
                @foreach($faqCategories as $key => $category)
                    <button @click="selectedCategory = '{{ $key }}'; openFaq = null"
                            :class="selectedCategory === '{{ $key }}' ? 'bg-blue-600 text-white' : 'bg-white text-slate-700 hover:bg-slate-100'"
                            class="px-6 py-2.5 rounded-lg font-medium transition-all shadow-sm border border-slate-200">
                        {{ $category[$currentLocale] }}
                    </button>
                @endforeach
            </div>

            <!-- FAQ Items -->
            <div class="space-y-12">
                @foreach($faqCategories as $categoryKey => $categoryName)
                    <div x-show="Object.keys(filteredFaqs).includes('{{ $categoryKey }}')" x-cloak>
                        <!-- Category Header -->
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    @if($categoryKey === 'accounts')
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                    @elseif($categoryKey === 'credits')
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    @elseif($categoryKey === 'security')
                                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    @elseif($categoryKey === 'services')
                                        <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"/>
                                        <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"/>
                                        <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"/>
                                    @else
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                    @endif
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900">{{ $categoryName[$currentLocale] }}</h2>
                        </div>

                        <!-- Questions -->
                        <div class="space-y-4">
                            @foreach($faqs[$categoryKey] as $index => $faq)
                                <div class="bg-white rounded-xl border-2 border-slate-200 overflow-hidden transition-all hover:shadow-md"
                                     :class="openFaq === '{{ $categoryKey }}-{{ $index }}' ? 'ring-2 ring-blue-500 border-blue-500' : ''">
                                    <!-- Question -->
                                    <button @click="openFaq = openFaq === '{{ $categoryKey }}-{{ $index }}' ? null : '{{ $categoryKey }}-{{ $index }}'"
                                            class="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                                        <span class="font-semibold text-lg text-slate-900 pr-4">{{ $faq['question'][$currentLocale] }}</span>
                                        <svg class="w-6 h-6 text-blue-600 flex-shrink-0 transition-transform"
                                             :class="openFaq === '{{ $categoryKey }}-{{ $index }}' ? 'rotate-180' : ''"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>

                                    <!-- Answer -->
                                    <div x-show="openFaq === '{{ $categoryKey }}-{{ $index }}'"
                                         x-collapse
                                         class="border-t border-slate-200">
                                        <div class="px-6 py-5 bg-slate-50">
                                            <p class="text-slate-700 leading-relaxed">{{ $faq['answer'][$currentLocale] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- No Results -->
            <div x-show="Object.keys(filteredFaqs).length === 0" x-cloak class="text-center py-16">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-xl font-semibold text-slate-700 mb-2">
                    @if($currentLocale === 'fr')
                        Aucun résultat trouvé
                    @elseif($currentLocale === 'de')
                        Keine Ergebnisse gefunden
                    @elseif($currentLocale === 'en')
                        No results found
                    @else
                        No se encontraron resultados
                    @endif
                </h3>
                <p class="text-slate-500">
                    @if($currentLocale === 'fr')
                        Essayez de modifier votre recherche ou contactez notre service client
                    @elseif($currentLocale === 'de')
                        Versuchen Sie, Ihre Suche zu ändern oder kontaktieren Sie unseren Kundenservice
                    @elseif($currentLocale === 'en')
                        Try modifying your search or contact our customer service
                    @else
                        Intente modificar su búsqueda o contacte con nuestro servicio al cliente
                    @endif
                </p>
            </div>

            <!-- Contact CTA -->
            <div class="mt-16 bg-gradient-to-br from-blue-900 to-slate-900 rounded-2xl p-8 md:p-12 text-center">
                <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">
                    @if($currentLocale === 'fr')
                        Vous n'avez pas trouvé de réponse ?
                    @elseif($currentLocale === 'de')
                        Haben Sie keine Antwort gefunden?
                    @elseif($currentLocale === 'en')
                        Didn't find an answer?
                    @else
                        ¿No encontró una respuesta?
                    @endif
                </h3>
                <p class="text-lg text-blue-100 mb-8">
                    @if($currentLocale === 'fr')
                        Notre équipe est là pour vous aider. Contactez-nous et nous vous répondrons rapidement.
                    @elseif($currentLocale === 'de')
                        Unser Team ist hier, um Ihnen zu helfen. Kontaktieren Sie uns und wir werden Ihnen schnell antworten.
                    @elseif($currentLocale === 'en')
                        Our team is here to help you. Contact us and we will respond quickly.
                    @else
                        Nuestro equipo está aquí para ayudarle. Contáctenos y le responderemos rápidamente.
                    @endif
                </p>
                <a href="{{ route('contact', ['locale' => $currentLocale]) }}"
                   class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-blue-50 text-blue-900 font-bold rounded-lg transition-all shadow-lg text-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    @if($currentLocale === 'fr')
                        Nous contacter
                    @elseif($currentLocale === 'de')
                        Kontaktieren Sie uns
                    @elseif($currentLocale === 'en')
                        Contact us
                    @else
                        Contáctenos
                    @endif
                </a>
            </div>
        </div>
    </section>

    @push('styles')
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @endpush
</x-layouts.app>
