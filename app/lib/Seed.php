<?php
declare(strict_types=1);

/** Default content loaded by the installer. Everything here is editable in the dashboard. */
final class Seed
{
    public static function settings(): array
    {
        return [
            'site_name' => 'CyberCraft',
            'legal_name' => 'CyberCraft Pvt. Ltd.',
            'site_url' => 'https://www.cybercraft.biz',
            'tagline' => 'An Innovation Technology Company',
            'meta_description' => 'CyberCraft Pvt. Ltd. is a corporate managed service provider: managed IT, cyber security, compliance and consultancy, networks and telecom, cloud, software and smart technology. Founded in Lahore in 2007, with a presence in Pakistan, the UAE, Saudi Arabia, the UK, the Czech Republic and Canada.',
            'email_info' => 'info@cybercraft.biz',
            'email_sales' => 'sales@cybercraft.biz',
            'email_support' => 'support@cybercraft.biz',
            'email_msp' => 'msp@cybercraft.biz',
            'email_audit' => 'audit@cybercraft.biz',
            'email_security' => 'security@cybercraft.biz',
            'email_horizons' => 'horizons@cybercraft.biz',
            'email_partners' => 'partners@cybercraft.biz',
            'email_careers' => 'careers@cybercraft.biz',
            'email_accounts' => 'accounts@cybercraft.biz',
            'email_ceo' => 'ceo@cybercraft.biz',
            'email_noc' => 'noc@cybercraft.biz',
            'phone' => '',
            'whatsapp' => '',
            'notify_email' => 'info@cybercraft.biz',
            'notify_enabled' => '1',
            'notify_route' => '1',
            'client_login_url' => '',
            'b2cloud_url' => 'https://b2cloud.io',
            'social_linkedin' => '',
            'social_x' => '',
            'social_facebook' => '',
            'social_instagram' => '',
            'social_youtube' => '',
            'announcement' => '',
            'animations' => '1',
            'show_products' => '0',
            'stats' => "17+ | Years in IT & telecom\n6 | Countries\n16 | Service areas\n24/7 | NOC & SOC\n20+ | Standards we audit to",
            'footer_text' => 'Run. Secure. Innovate. Corporate managed IT, cyber security and telecom services, from Lahore since 2007.',
            'show_sample_badges' => '0',
        ];
    }

    /** [key, page, label, type, value] */
    public static function blocks(): array
    {
        return [
            ['home_tagline', 'Home', 'Tagline (words separated by full stops)', 'text', 'Run. Secure. Innovate.'],
            ['home_label', 'Home', 'Small line above the headline', 'text', 'Corporate managed service provider · Since 2007'],
            ['home_headline', 'Home', 'Headline', 'text', 'Managed Services, Cyber Security & Consultancy Services for Corporate Organizations.'],
            ['home_sub', 'Home', 'Text under the headline', 'textarea', 'We run your IT and networks around the clock, secure and audit them to international standards, and deliver cloud, software, connectivity and smart technology projects.'],
            ['home_cta_primary', 'Home', 'Primary button text', 'text', 'Get a free consultation'],
            ['home_cta_secondary', 'Home', 'Secondary button text', 'text', 'See all services'],
            ['home_pillars_title', 'Home', 'Core services title', 'text', 'Run. Secure. Innovate.'],
            ['home_pillars_intro', 'Home', 'Core services introduction', 'textarea', 'Three core services under one accountable partner. Most clients start with one; many combine all three under a single agreement.'],
            ['home_areas_title', 'Home', 'All services title', 'text', 'Everything we do in IT and telecom.'],
            ['home_areas_intro', 'Home', 'All services introduction', 'textarea', 'Sixteen service areas, delivered by our own engineers and our JV partners. Take one service, or combine several under one agreement.'],
            ['home_plans_title', 'Home', 'Service plans title', 'text', 'Choose how much of your IT we take on.'],
            ['home_plans_intro', 'Home', 'Service plans introduction', 'textarea', 'Every plan includes monitoring, security patching and a monthly report. Each plan is quoted for your number of users and sites.'],
            ['home_compliance_title', 'Home', 'Compliance title', 'text', 'Audit-ready for the standards that apply where you operate.'],
            ['home_compliance_intro', 'Home', 'Compliance introduction', 'textarea', 'An independent team audits your controls, reports risk-rated findings and helps you close every gap before the certification or regulator visit.'],
            ['home_industries_title', 'Home', 'Industries title', 'text', 'Serving organizations that cannot afford downtime.'],
            ['home_industries_intro', 'Home', 'Industries introduction', 'textarea', 'The same services, applied to the rules, risks and uptime needs of your sector.'],
            ['home_also_title', 'Home', 'Supporting services title', 'text', 'We also deliver'],
            ['home_products_title', 'Home', 'Products title', 'text', 'Built and run by CyberCraft.'],
            ['home_clients_title', 'Home', 'Clients title', 'text', 'Trusted by organizations in six countries'],
            ['home_why_title', 'Home', 'Why CyberCraft title', 'text', 'Why organizations choose CyberCraft'],
            ['home_cta_band_title', 'Home', 'Bottom call-to-action title', 'text', 'Talk to us about your IT and security'],
            ['home_cta_band_body', 'Home', 'Bottom call-to-action text', 'textarea', 'Book a free consultation. We review your IT and security and reply with a clear proposal within one business day.'],

            ['ceo_quote', 'About', 'CEO pull-quote', 'textarea', 'Every organization now asks two questions: is our technology secure, and can we prove it? We exist to answer both, and to put new technology to work for our clients.'],
            ['ceo_name', 'About', 'CEO name', 'text', 'Tauseef Ahmed'],
            ['ceo_role', 'About', 'CEO title', 'text', 'Founder & CEO, CyberCraft Pvt. Ltd.'],
            ['ceo_message', 'About', 'CEO message (Markdown)', 'markdown', "When I started CyberCraft in 2007, our goal was simple: help businesses use technology to work better. Over the years we built software, ERP systems, data centers and networks, and our clients trusted us to keep running them. That trust is the heart of our first pillar, managed services.\n\nToday every organization faces the same two questions: is our technology secure, and can we prove it? Our second pillar, cyber security compliance and audit, exists to answer both, honestly and to international standards.\n\nOur third pillar, innovation and smart technology, is our commitment to the future. Clean energy, automation, embedded systems and AI will change how every business works, and we intend to help lead that change, not just watch it.\n\nBecoming CyberCraft Pvt. Ltd. in 2024, and expanding to the UAE, KSA, UK, Czech Republic and Canada, is a new chapter for us. What we stand for has not changed: accountability, honest advice and real value for every client."],
            ['about_title', 'About', 'Page title', 'text', 'From Lahore, since 2007.'],
            ['about_intro', 'About', 'Introduction', 'textarea', 'We started by building systems. Clients asked us to run them, then to secure them. Today we are a corporate managed service provider with our own innovation lab.'],
            ['about_body', 'About', 'Our story (Markdown)', 'markdown', "CyberCraft started in 2007 with a simple idea: **help businesses work better with technology.** Our first work was bringing computers, networks and software into offices across Lahore.\n\nOver the years we built software, our own ERP platform CyberERP, and data centers and networks. Clients kept asking us to stay on and run what we had built, so we became a **managed services provider**, placing resident engineers inside client organizations and, often, running a client's entire IT function.\n\nRunning clients' systems made one thing clear: every system must be secure, and clients must be able to prove it. That became our second pillar, **cyber security compliance and audit**.\n\nIn 2024 we incorporated as **CyberCraft Pvt. Ltd.**, expanded to five more countries and launched our third pillar, **innovation and smart technology**."],
            ['about_timeline', 'About', 'Timeline (one per line: Year | text)', 'lines', "2007 | Founded in Lahore as a sole proprietorship: computerization, networking and software\nGrowth years | CyberERP, data centers, networks, IP communications and surveillance\nGrowth years | Managed services and the resident-engineer model\nGrowth years | Cyber security audit and compliance practice; b2cloud.io launched\n2024 | Incorporated as CyberCraft Pvt. Ltd.: An Innovation Technology Company\n2024 onward | UAE, KSA, UK, Czech Republic and Canada; innovation lab launched"],
            ['about_vision', 'About', 'Vision', 'textarea', 'To be the trusted partner that runs, secures and innovates technology for organizations, from Pakistan to the world.'],
            ['about_mission', 'About', 'Mission', 'textarea', "To keep our clients' technology running, secure and compliant through managed services and cyber security assurance, and to deliver the new technology that moves them forward."],
            ['about_values', 'About', 'Values (one per line: Value | meaning)', 'lines', "Accountability | When we manage a system, we own its outcome\nIntegrity | Honest findings in every audit and honest advice in every proposal\nVigilance | Security and compliance are continuous work, not an annual event\nInnovation | We adapt, innovate and improvise, and invest in new technology\nValue for money | Enterprise-grade service at a cost that makes sense\nContinuous learning | Threats, standards and technology change, and so do our skills"],
            ['about_partners', 'About', 'Partnerships text (Markdown)', 'markdown', "CyberCraft delivers through its own teams and a network of **joint-venture (JV) partners** in Pakistan and abroad. These partnerships let us bid for and deliver large and government programs, bring in certified auditors, testers and engineers when needed, source equipment competitively and support clients locally in five countries.\n\nWe welcome partnerships with technology vendors, audit firms, system integrators, distributors and investors."],

            ['services_title', 'Services', 'Page title', 'text', 'Everything we deliver'],
            ['services_intro', 'Services', 'Introduction', 'textarea', 'Sixteen service areas across managed IT, cyber security, telecom, cloud, software and smart technology. Take any service on its own or combine them under one agreement.'],
            ['pillars_title', 'Services', '"What we do" page title', 'text', 'Managed IT, cyber security and innovation'],
            ['pillars_intro', 'Services', '"What we do" introduction', 'textarea', 'Three core services under one accountable partner: we manage your IT, audit and secure it, and deliver new technology such as solar, automation and AI.'],

            ['industries_title', 'Industries', 'Page title', 'text', 'Serving organizations that cannot afford downtime'],
            ['industries_intro', 'Industries', 'Introduction', 'textarea', 'The same services, applied to the rules, risks and uptime needs of your sector.'],

            ['products_title', 'Products', 'Page title', 'text', 'Built and run by CyberCraft'],
            ['products_intro', 'Products', 'Introduction', 'textarea', 'Our own ERP platform and our cloud and hosting brand.'],

            ['clients_title', 'Clients', 'Page title', 'text', 'Trusted across six countries'],
            ['clients_intro', 'Clients', 'Introduction', 'textarea', 'Corporate, government, healthcare, manufacturing, energy and hospitality organizations rely on CyberCraft to run and secure their IT.'],

            ['careers_title', 'Careers', 'Page title', 'text', 'Build your career at CyberCraft'],
            ['careers_intro', 'Careers', 'Introduction', 'textarea', 'Service desk and NOC engineers, auditors and penetration testers, SOC analysts, solar and automation engineers, developers and ERP consultants.'],
            ['careers_body', 'Careers', 'Main text (Markdown)', 'markdown', "## Why work with us\n- Real responsibility for live client systems\n- Security and audit work to international standards\n- Innovation projects in solar, automation and AI\n- International exposure across six countries\n- Certification support: ITIL, CEH, OSCP, CISA, ISO 27001 Lead Auditor and more\n\n## Career areas\nManaged services · Cyber security & audit · Innovation R&D · Networks & telecom · Cloud · Software & ERP · Sales & business development\n\n## How to apply\nSend your CV and the area you're interested in through the contact form (choose **Careers**) or email careers@cybercraft.biz."],

            ['contact_title', 'Contact', 'Page title', 'text', "Let's talk"],
            ['contact_intro', 'Contact', 'Introduction', 'textarea', 'Tell us what you need and the right team will reply within one business day.'],
            ['contact_success', 'Contact', 'Message shown after sending', 'textarea', "Thank you. Your message has reached the right team and we'll be in touch within one business day."],

            ['privacy_body', 'Legal', 'Privacy policy (Markdown)', 'markdown', "## Who we are\nCyberCraft Pvt. Ltd. (\"we\", \"us\") provides managed services, cyber security compliance and audit, and technology solutions. This policy explains how we handle personal data on this website.\n\n## What we collect\n- Details you send through our contact form: name, email, company, phone, country and your message.\n- Basic technical data needed to run the site securely, such as IP address and browser type.\n\n## How we use it\nWe use your details only to respond to your enquiry and to provide our services. We do not sell personal data.\n\n## Cookies\nThis website uses only essential cookies needed for security and forms. We do not use advertising cookies.\n\n## Your rights\nYou can ask us to access, correct or delete your data at any time by emailing info@cybercraft.biz.\n\n*[Placeholder policy. Please have it reviewed for each country where you operate before launch.]*"],
            ['terms_body', 'Legal', 'Terms of use (Markdown)', 'markdown', "## Website terms\nThis website is provided by CyberCraft Pvt. Ltd. for general information about our services.\n\n## Services\nServices are provided under a separate client agreement, which takes precedence over anything on this website.\n\n## Contact\nQuestions about these terms: info@cybercraft.biz\n\n*[Placeholder terms. Please have them reviewed before launch.]*"],
        ];
    }

    /** [slug, name, short, promise, motto, summary, intro, lead_product, accent, is_core, image, highlights] */
    public static function practices(): array
    {
        return [
            ['managed-services', 'Managed IT Services', 'Managed IT Services', 'We run your IT so your team can focus on the business.', '', 'Complete IT outsourcing, resident engineers, service desk and 24/7 monitoring.', 'CyberCraft is a corporate managed service provider. We take responsibility for your servers, networks, cloud, devices and users under agreed service levels, with a 24/7 operations center, monthly reports and security built into everything we manage.', 'Service plans from remote support to full outsourcing', 'msp', 1, 'photos/managed-it.jpg', "Complete IT outsourcing for a fixed monthly cost\nResident engineers working at your premises\nService desk and 24/7 network operations center\nServers, networks, cloud and Microsoft 365 managed"],
            ['compliance-audit', 'Cyber Security Audit & Compliance', 'Cyber Security & Audit', 'We secure your systems and get you audit-ready.', '', 'Security audits, penetration testing, ISO 27001 and regulatory compliance, 24/7 SOC.', 'Independent security audits and penetration tests against the standards your regulators, customers and board expect, followed by hands-on help to close the gaps and 24/7 monitoring to stay secure. When we also manage your systems, a separate team performs the audit.', 'Audit, compliance readiness and managed SOC', 'audit', 1, 'photos/cyber-security.jpg', "Security audits and penetration testing\nISO 27001, PCI DSS and SOC 2 readiness\nRegional compliance: NCA, UAE IA, GDPR and more\n24/7 security operations center (SOC)\nConsultancy, policies and a virtual CISO"],
            ['innovation', 'Innovation & Smart Technology', 'Innovation', 'Solar, automation, IoT and AI that cut costs and add capability.', 'Adapt · Innovate · Improvise', 'Solar and clean energy, industrial automation, IoT, smart buildings and AI.', 'Our innovation lab in Lahore adapts proven global technology to local conditions, designs new solutions and improvises on the ground: power outages, remote sites, tight budgets and harsh environments.', 'Solar, automation, IoT and AI projects', 'horizons', 1, 'photos/innovation-collage.jpg', "Solar, battery storage and EV charging\nIndustrial automation, PLC and SCADA\nIoT sensors and smart buildings\nAI assistants and document automation\nEmbedded systems, drones and robotics"],
            ['solutions', 'IT & Telecom Solutions', 'IT & Telecom', 'Networks, telecom, data centers, cloud, software and hardware.', '', 'Networks and connectivity, telecom, IP telephony, data centers, cloud hosting, software and ERP, and IT hardware.', 'Seventeen years of engineering behind everything we manage and secure, also available as projects on their own.', 'CyberERP · b2cloud.io', 'support', 0, 'photos/svc-data-center.jpg', "Networks, fiber and enterprise Wi-Fi\nTelecom, towers and satellite links\nData centers, cloud and b2cloud.io hosting\nSoftware, ERP and IT hardware supply"],
        ];
    }

    /** practice slug => [slug, tag, name, summary, description, do, get, ideal, image, sort] (sort sets the homepage order) */
    public static function services(): array
    {
        return [
            'managed-services' => [
                ['managed-it-outsourcing', 'Run', 'Managed IT & Outsourcing', 'We run your entire IT function, or the parts you choose, for a fixed monthly cost.', 'CyberCraft takes over day-to-day IT for corporate organizations: servers, networks, cloud, users, vendors and security, under one agreement and agreed service levels. Choose complete outsourcing or resident engineers at your premises.', "Complete IT outsourcing\nResident engineers on site\nIT staff augmentation\nMicrosoft 365 & Google Workspace\nBackup & disaster recovery\nAMC & hardware maintenance", "Predictable monthly cost\nSLA-backed response and uptime\nOne accountable partner", 'Organizations without, or outgrowing, an in-house IT team.', 'photos/svc-outsourcing.jpg', 10],
                ['service-desk-noc', 'Run', 'Service Desk & 24/7 NOC', 'L1–L3 support for your users and round-the-clock monitoring of your systems.', 'A multi-channel service desk for your staff and a 24/7 network operations center that watches your servers, networks, links and applications, so issues are fixed before users notice.', "L1–L3 help desk\nPhone, email, chat & WhatsApp support\n24/7 network and server monitoring\nPatch & update management\nITIL incident & change management\nMonthly SLA reports", "Faster resolution\nIssues caught early\nFull ticket history and reports", 'Any organization that depends on IT being available.', 'photos/svc-noc.jpg', 20],
                ['contact-center-bpo', 'Run', 'Contact Center & BPO', 'Inbound and outbound call center, omnichannel support and back-office services.', 'Customer support and sales teams run from our delivery center, on your brand and your scripts, across phone, email, chat and social channels, with AI agents for routine calls.', "Inbound & outbound call center\nOmnichannel customer support\nHelp desk outsourcing\nContact center software\nCall quality monitoring\nBack-office services", "Lower cost per contact\nExtended or 24/7 coverage\nQuality reports every month", 'Retail, telecom, healthcare and service companies.', 'photos/svc-contact-center.jpg', 140],
            ],
            'compliance-audit' => [
                ['cyber-security-soc', 'Secure', 'Cyber Security & SOC', '24/7 security monitoring, detection and response, plus managed protection.', 'A 24/7 security operations center with SIEM monitoring and incident response, and managed protection for your firewalls, endpoints, email and identities.', "24/7 SOC & SIEM monitoring\nFirewall & UTM management\nEndpoint protection (EDR)\nEmail security & anti-phishing\nMFA, PAM & identity\nDDoS protection & WAF", "Threats detected and contained around the clock\nMonthly security reports\nOne team for every security tool", 'Organizations without a 24/7 security team.', 'photos/svc-security.jpg', 30],
                ['audit-compliance', 'Secure', 'Audit & Compliance', 'Independent audits, penetration testing and readiness for ISO 27001 and regulators.', 'Security audits and penetration tests against the standards your regulators, customers and board expect, then hands-on help to close every gap. When we also manage your systems, a separate team performs the audit.', "Security audits & gap assessments\nPenetration testing (VAPT)\nISO 27001, PCI DSS & SOC 2\nNCA, UAE IA, GDPR & PECA\nBusiness continuity & DR plans\nSecurity awareness training", "Risk-rated findings with clear fixes\nRe-test to confirm closure\nReady for certification or inspection", 'Organizations facing a certification, regulator or customer deadline.', 'photos/audit-compliance.jpg', 40],
                ['ip-surveillance-access-control', 'Secure', 'IP Surveillance & Access Control', 'IP CCTV, video analytics, access control and central monitoring rooms.', 'Design, installation and management of IP camera systems, access control and alarm systems for offices, plants, campuses and cities, connected to a central monitoring room.', "IP CCTV & video analytics\nANPR & people counting\nAccess control & time attendance\nCentral monitoring rooms\nIntrusion & alarm systems\nSmart city surveillance", "Every site visible from one place\nEvidence you can rely on\nMaintenance under one contract", 'Offices, factories, warehouses, campuses and public spaces.', 'photos/svc-surveillance.jpg', 110],
            ],
            'innovation' => [
                ['ai-data-digitization', 'Innovate', 'AI, Data & Digitization', 'AI assistants, document AI, dashboards and digitization of paper records.', 'Practical AI and data projects that save time and money: assistants and chatbots, intelligent document processing, business intelligence dashboards and scanning of paper archives.', "AI assistants & chatbots\nDocument AI & OCR\nDashboards & business intelligence\nDocument scanning & archives\nWorkflow automation & RPA\nAI voice agents", "Less manual work\nFaster decisions from your data\nSearchable records", 'Corporates, insurers, retailers, hospitals and government.', 'photos/svc-ai-data.jpg', 120],
                ['solar-clean-energy', 'Innovate', 'Solar & Clean Energy', 'Solar, battery storage and EV charging for offices, factories and telecom sites.', 'Commercial and industrial solar, hybrid systems for telecom and remote sites, battery storage, net metering and EV charging, with monitoring and maintenance.', "On-grid, off-grid & hybrid solar\nBattery storage\nNet metering\nEV charging\nEnergy monitoring\nOperation & maintenance", "Lower energy bills\nPower through outages\nMonitored performance", 'Offices, factories, hotels, telecom towers and remote sites.', 'photos/innovation-solar.jpg', 150],
                ['automation-iot-robotics', 'Innovate', 'Automation, IoT & Robotics', 'PLC and SCADA, Industry 4.0, embedded systems, smart buildings and robotics.', 'Automation and control for plants and utilities, connected devices and sensors, smart buildings and research projects in robotics, drones and health technology.', "PLC, SCADA & HMI\nMES & Industry 4.0\nEmbedded systems & IoT\nSmart buildings & home automation\nDrones & robotics\nHealth-tech & biotech R&D", "Higher throughput and quality\nReal-time data from the field\nPilots before full rollout", 'Manufacturing, utilities, real estate and product companies.', 'photos/svc-automation.jpg', 160],
            ],
            'solutions' => [
                ['networks-connectivity', 'Connect', 'Networks & Connectivity', 'LAN/WAN, structured cabling and fiber, enterprise Wi-Fi, SD-WAN and wireless links.', 'Design, build and support of the networks that connect your offices, plants and branches, from cabling and Wi-Fi to SD-WAN and point-to-point wireless links.', "LAN/WAN design & build\nStructured cabling & fiber\nEnterprise Wi-Fi\nSD-WAN & VPN\nPoint-to-point wireless links\nISP & link management", "Fast, reliable connectivity\nDocumented, tested networks\nOne contact for every link", 'Multi-site companies, campuses, plants and hotels.', 'photos/svc-networks.jpg', 50],
                ['telecom-towers-satellite', 'Connect', 'Telecom, Towers & Satellite', 'Tower and fiber rollout, VSAT and microwave links, telecom site power and IP exchange.', 'Telecom infrastructure services for operators, ISPs and enterprises: tower and fiber rollout, satellite and microwave links, site power, and IP exchange and SIP trunking.', "Tower & fiber rollout\nVSAT & satellite links\nMicrowave links\nTelecom site power & solar\nIP exchange & SIP trunks\nCarrier & ISP services", "Connectivity for remote sites\nFaster network rollout\nLower site power costs", 'Telecom operators, ISPs, energy and remote-site businesses.', 'photos/svc-telecom.jpg', 60],
                ['ip-telephony-collaboration', 'Connect', 'IP Telephony & Collaboration', 'IP PBX and VoIP, video conferencing rooms, Teams calling and meeting room AV.', 'Business phone systems and collaboration tools that work across all your offices, from IP PBX and VoIP to video conferencing rooms and Microsoft Teams calling.', "IP PBX & VoIP\nVideo conferencing rooms\nMicrosoft Teams calling\nCall recording & IVR\nMeeting room audio-visual\nIP intercom", "Lower call costs\nOne system for every office\nMeetings that just work", 'Head offices, branches, hotels and contact centers.', 'photos/svc-unified-comms.jpg', 70],
                ['data-centers-infrastructure', 'Build', 'Data Centers & Infrastructure', 'Data center and server room design and build, servers, storage and virtualization.', 'We design, build and operate data centers and server rooms, and supply and manage the servers, storage, virtualization, power and cooling inside them.', "Data center design & build\nServer rooms & racks\nServers & storage\nVirtualization (VMware, Hyper-V)\nUPS, cooling & power\nData center operations", "Reliable, documented infrastructure\nCapacity planned for growth\nOperated by our NOC", 'Corporates, government and any organization running its own servers.', 'photos/svc-data-center.jpg', 80],
                ['cloud-hosting', 'Build', 'Cloud & Hosting · b2cloud.io', 'Web hosting, VPS, business email, cloud migration and ERP hosting through b2cloud.io.', 'Hosting and cloud through our own brand b2cloud.io, and migration to and management of AWS, Microsoft Azure and Google Cloud.', "Web hosting & VPS\nDedicated servers & colocation\nBusiness email & domains\nMigration to AWS, Azure, Google Cloud\nERP & application hosting\nCloud backup", "Local support for your cloud\nPredictable hosting costs\nBackups that are tested", 'Any business that needs reliable hosting or a move to the cloud.', 'photos/svc-cloud.jpg', 90],
                ['software-erp-apps', 'Build', 'Software, ERP & Apps', 'CyberERP, Dynamics 365, SAP and Oracle, custom web and mobile apps, websites.', 'Our own ERP platform CyberERP, implementation and support for Microsoft Dynamics 365, SAP and Oracle, and custom web and mobile applications.', "CyberERP\nDynamics 365, SAP & Oracle\nWeb & mobile apps\nWebsites & e-commerce\nIntegration & APIs\nDevOps & QA testing", "Software that fits your process\nOne team from design to support\nIntegrated systems, not islands", 'Retail, manufacturing, education, healthcare and services companies.', 'photos/svc-software.jpg', 100],
                ['it-hardware-licensing', 'Supply', 'IT Hardware & Licensing', 'Laptops, servers and network equipment, and Microsoft, Adobe and security licenses.', 'Supply of IT equipment and software licenses at competitive prices, with license compliance, renewals, asset tracking and warranty support.', "Laptops, desktops & printers\nServers, storage & network gear\nMicrosoft, Adobe & antivirus licenses\nLicense renewals & compliance\nIT asset management\nWarranty & repair", "Competitive pricing\nLicensed, compliant software\nOne supplier for everything IT", 'Organizations buying IT equipment or renewing licenses.', 'photos/svc-hardware.jpg', 130],
            ],
        ];
    }

    /** Homepage carousel: [image, title, subtitle, link] */
    public static function slides(): array
    {
        return [
            ['photos/hero-managed-it.jpg', 'Managed IT', 'Service desk, NOC, outsourcing', 'what-we-do/managed-services'],
            ['photos/hero-cyber-security.jpg', 'Cyber security', 'Audit, VAPT, 24/7 SOC', 'what-we-do/compliance-audit'],
            ['photos/hero-cloud-hosting.jpg', 'Cloud & hosting', 'b2cloud.io, data centers', 'services/cloud-hosting'],
            ['photos/hero-connectivity.jpg', 'Connectivity & telecom', 'Networks, fiber, towers, satellite', 'services/networks-connectivity'],
            ['photos/hero-software-erp.jpg', 'Software & ERP', 'CyberERP, Dynamics 365, SAP', 'services/software-erp-apps'],
            ['photos/hero-smart-technology.jpg', 'Smart technology', 'Solar, automation, IoT, AI', 'what-we-do/innovation'],
        ];
    }

    /** [name, audience, items, featured] */
    public static function levels(): array
    {
        return [
            ['Essential', 'Remote support for small offices.', "Remote service desk (business hours)\nMonitoring and patching\nBackup checks\nMonthly report", 0],
            ['Professional', 'Remote support plus scheduled visits for growing companies.', "Everything in Essential\nScheduled onsite visits\nHardware and network maintenance (AMC)\nAsset and license management", 0],
            ['Enterprise', 'Complete IT outsourcing for corporate organizations.', "Your entire IT function, run by CyberCraft\n24/7 monitoring and support\nDedicated service manager\nCustom SLAs and monthly reviews", 1],
            ['Resident Engineer', 'Engineers working full-time at your premises.', "Dedicated onsite engineers\nBackfill during leave\nRemote specialist escalation\nCyberCraft tools and processes", 0],
        ];
    }

    public static function commitments(): array
    {
        return [
            ['We run it', 'Resident engineers and complete outsourcing.'],
            ['We prove it', 'Audits to international and regional standards.'],
            ['We innovate', 'A dedicated lab for energy, automation and AI.'],
            ['One partner', 'IT, security and innovation under one agreement.'],
            ['Lower cost', 'A Lahore delivery center and the resident model.'],
            ['Six countries', 'Local contact, global standards.'],
            ['Engineering depth', 'Our own ERP, software and network expertise.'],
            ['Scalable', 'Own teams plus a JV partner network.'],
            ['Honest audits', 'Independent teams, risk-rated findings.'],
            ['Personal attention', 'Leadership on every key account.'],
        ];
    }

    public static function steps(): array
    {
        return [
            ['Assess', 'A free consultation and a review of your systems, risks and goals.'],
            ['Propose', 'A clear written proposal with scope, service levels and cost.'],
            ['Deliver', 'We take over, audit or build, with minimal disruption and full documentation.'],
            ['Support', 'Monthly reviews, reports and continuous improvement.'],
        ];
    }

    /** [country, code, city, region, description, email, is_hq] */
    public static function offices(): array
    {
        return [
            ['Pakistan', 'PK', 'Lahore', 'Headquarters & delivery center', 'Managed IT, 24/7 NOC and SOC, audit team and innovation lab.', 'pk@cybercraft.biz', 1],
            ['United Arab Emirates', 'AE', 'Dubai', 'Middle East', 'Managed services, UAE IA and DESC compliance, smart solutions.', 'uae@cybercraft.biz', 0],
            ['Saudi Arabia', 'SA', 'Riyadh', 'Middle East', 'Managed IT, NCA compliance and energy projects.', 'ksa@cybercraft.biz', 0],
            ['United Kingdom', 'GB', 'London', 'Europe', 'Managed services, Cyber Essentials, ISO 27001 and UK GDPR.', 'uk@cybercraft.biz', 0],
            ['Czech Republic', 'CZ', 'Prague', 'Central Europe', 'Managed services, GDPR and NIS2 readiness, automation.', 'cz@cybercraft.biz', 0],
            ['Canada', 'CA', 'Toronto', 'North America', 'Managed services, PIPEDA and SOC 2 readiness.', 'ca@cybercraft.biz', 0],
        ];
    }

    /** [slug, name, icon, summary, msp, audit, horizons] */
    public static function industries(): array
    {
        return [
            ['corporate-enterprise', 'Corporate & enterprise', 'building', 'Head offices and multi-site companies that need IT run reliably and securely.', 'Complete IT outsourcing and resident engineers', 'ISO 27001, VAPT and security awareness', 'Solar and smart offices'],
            ['government', 'Government', 'gov', 'IT outsourcing, data center operations, national standards and smart city.', 'IT outsourcing and data center operations', 'National standards, audits and awareness', 'Smart city and e-governance'],
            ['telecom-isps', 'Telecom & ISPs', 'tower', 'Network operations, NOC, PTA requirements and tower solar power.', 'Network operations and NOC', 'PTA requirements and VAPT', 'Tower solar power and IoT'],
            ['healthcare', 'Healthcare', 'health', 'Hospital IT, HIPAA and ADHICS compliance, remote patient monitoring.', 'Hospital IT management', 'HIPAA, ADHICS and data protection', 'Remote patient monitoring'],
            ['manufacturing', 'Manufacturing', 'factory', 'Plant IT and OT support, OT security, automation and machine vision.', 'Plant IT and OT support', 'OT security and ISO 27001', 'Industrial automation and machine vision'],
            ['energy-utilities', 'Energy & utilities', 'bolt', 'Remote sites, satellite links, SCADA security, solar and smart metering.', 'Remote site IT and satellite links', 'OT and SCADA security', 'Solar, SCADA and smart metering'],
            ['retail-fmcg', 'Retail & FMCG', 'bag', 'Store and warehouse IT, PCI DSS, analytics and energy savings.', 'Store and warehouse IT', 'PCI DSS and VAPT', 'Energy savings and analytics'],
            ['education', 'Education', 'cap', 'Campus IT management, data protection and smart campus.', 'Campus IT management', 'Data protection and awareness', 'Smart campus'],
            ['real-estate', 'Real estate', 'building', 'Site connectivity, surveillance, access audits and smart buildings.', 'Site connectivity and surveillance', 'Access-control audits', 'Smart buildings'],
            ['logistics', 'Logistics', 'truck', 'Fleet and depot IT, data protection and fleet IoT.', 'Fleet and depot IT', 'Data protection', 'Fleet IoT'],
            ['hospitality', 'Hospitality', 'hotel', 'Hotel IT, guest Wi-Fi, PCI DSS and smart rooms.', 'Hotel IT and guest Wi-Fi', 'PCI DSS', 'Smart rooms'],
            ['ngos-development', 'NGOs & development', 'heart', 'Low-cost IT management, donor data protection, solar for communities.', 'Low-cost IT management', 'Donor data protection', 'Solar for communities'],
        ];
    }

    /** [slug, name, label, summary, items, accent, url, image] */
    public static function products(): array
    {
        return [
            ['cybererp', 'CyberERP', 'Our ERP platform', 'Our own ERP for finance, HR and payroll, inventory, sales, POS, manufacturing and reporting.', "Retail & distribution\nManufacturing\nEducation\nHealthcare\nReal estate\nServices", 'sky', '', 'photos/software-erp.jpg'],
            ['b2cloud', 'b2cloud.io', 'Our cloud & hosting brand', 'Business hosting and cloud: websites, email, servers, backup, disaster recovery and hosted ERP.', "Web hosting and VPS\nDedicated servers\nBusiness email and domains\nBackup and disaster recovery\nColocation\nERP cloud", 'support', 'https://b2cloud.io', 'photos/cloud-hosting.jpg'],
        ];
    }

    /** Fictitious sample clients: [name, country, industry, color] */
    public static function clients(): array
    {
        return [
            ['Ravi Steel Works', 'PK', 'Manufacturing', '#1F4FA8'], ['Margalla Health', 'PK', 'Healthcare', '#0E7490'],
            ['Indus Pharma', 'PK', 'Healthcare', '#7C3AED'], ['Shalimar Logistics', 'PK', 'Logistics', '#B45309'],
            ['Desert Rose Hotels', 'AE', 'Hospitality', '#BE123C'], ['Al Noor Trading', 'AE', 'Retail & FMCG', '#0F766E'],
            ['Palm Coast Energy', 'AE', 'Energy & utilities', '#CA8A04'], ['Najd Industrial Group', 'SA', 'Manufacturing', '#15803D'],
            ['Hijaz Medical Center', 'SA', 'Healthcare', '#0369A1'], ['Qassim Agro', 'SA', 'Manufacturing', '#A16207'],
            ['Thamesbridge Consulting', 'GB', 'Corporate & enterprise', '#1E3A8A'], ['Pennine Engineering', 'GB', 'Manufacturing', '#9F1239'],
            ['Vltava Systems', 'CZ', 'Telecom & ISPs', '#0F766E'], ['Morava Glassworks', 'CZ', 'Manufacturing', '#6D28D9'],
            ['Maple North Logistics', 'CA', 'Logistics', '#B91C1C'], ['Laurentian Clinics', 'CA', 'Healthcare', '#0E7490'],
            ['Indus Cloud Telecom', 'PK', 'Telecom & ISPs', '#2563EB'], ['Gulf Crest Holdings', 'AE', 'Corporate & enterprise', '#0E9AA7'],
        ];
    }

    /** Sample case studies: [title, client, pillar, country, challenge, solution, result] */
    public static function caseStudies(): array
    {
        return [
            ['Complete IT outsourcing across two plants', 'Ravi Steel Works', 'Managed IT', 'PK', 'High IT costs and an unreliable in-house setup across two plants.', 'Enterprise managed IT plan with resident engineers and 24/7 monitoring.', 'Predictable monthly IT cost, SLA-backed uptime'],
            ['NCA compliance and 24/7 SOC', 'Najd Industrial Group', 'Cyber security & audit', 'SA', 'An NCA ECC deadline and no round-the-clock security monitoring.', 'Gap assessment and remediation, then 24/7 managed SOC.', 'Inspection-ready controls, 24/7 monitoring'],
            ['ISO 27001 readiness in a year', 'Thamesbridge Consulting', 'Cyber security & audit', 'GB', 'A major customer required ISO 27001 certification within a year.', 'Security audit, policy framework, penetration testing and internal audit.', 'Ready for the external certification audit'],
            ['Solar power and smart rooms', 'Desert Rose Hotels', 'Innovation', 'AE', 'Rising energy costs across three properties.', 'Solar with battery storage and smart room controls.', 'Lower energy bills, better guest comfort'],
        ];
    }

    /** [region, items] */
    public static function standards(): array
    {
        return [
            ['International', "ISO 27001\nISO 27701\nISO 22301\nISO 20000\nPCI DSS\nSOC 2\nNIST CSF\nCIS Controls\nHIPAA"],
            ['Pakistan', "PECA 2016\nPTA\nSECP"],
            ['Saudi Arabia', "NCA ECC\nKSA PDPL"],
            ['United Arab Emirates', "UAE IA\nDESC ISR\nADHICS\nUAE PDPL"],
            ['United Kingdom', "Cyber Essentials\nUK GDPR"],
            ['European Union', "GDPR\nNIS2"],
            ['Canada', "PIPEDA"],
        ];
    }

    public static function faqs(): array
    {
        return [
            ['What does CyberCraft do?', 'CyberCraft is a corporate managed service provider. We run and support your IT (servers, networks, cloud, devices and users), audit and secure it against international and regional standards, and deliver innovation projects such as solar, automation and AI.'],
            ['What is included in managed IT services?', 'A service desk for your users, 24/7 monitoring, patching and backups, network and cloud management, hardware maintenance and vendor management. You can also have resident engineers at your site, or hand over your entire IT function.'],
            ['Can you audit systems you also manage for us?', 'Yes. When we both manage and audit a client\'s systems, the audit is performed by a separate team, and you can request third-party validation.'],
            ['Which standards can you prepare us for?', 'International standards such as ISO 27001, PCI DSS and SOC 2, and regional frameworks including NCA ECC (Saudi Arabia), UAE IA and DESC (UAE), PECA and PTA (Pakistan), Cyber Essentials (UK), GDPR and NIS2 (EU) and PIPEDA (Canada).'],
            ['Do you work outside Pakistan?', 'Yes. We have a presence in the UAE, Saudi Arabia, the United Kingdom, the Czech Republic and Canada, backed by our 24/7 operations center in Lahore.'],
            ['How do we start?', 'Book a free consultation through the contact form or email info@cybercraft.biz. We review your setup and send a written proposal with scope, service levels and cost.'],
        ];
    }

    public static function run(): void
    {
        $now = now();
        foreach (self::settings() as $k => $v) {
            Db::exec('INSERT IGNORE INTO settings (k, v) VALUES (?, ?)', [$k, $v]);
        }
        foreach (self::blocks() as $i => [$k, $page, $label, $type, $v]) {
            Db::exec('INSERT IGNORE INTO blocks (k, page, label, type, v, sort) VALUES (?,?,?,?,?,?)', [$k, $page, $label, $type, $v, $i]);
        }
        if ((int)Db::value('SELECT COUNT(*) FROM practices') > 0) {
            return; // content already present: Upgrade::run() brings it up to date
        }
        // Brand-new content is already current, so mark it with the content version
        Db::exec('INSERT INTO settings (k, v) VALUES (?, ?) ON DUPLICATE KEY UPDATE v = VALUES(v)', ['content_version', Upgrade::VERSION]);
        $pids = [];
        foreach (self::practices() as $i => [$slug, $name, $short, $promise, $motto, $summary, $intro, $lead, $accent, $core, $img, $hl]) {
            $pids[$slug] = Db::insert('practices', ['slug' => $slug, 'name' => $name, 'short_name' => $short, 'promise' => $promise, 'motto' => $motto, 'summary' => $summary, 'intro' => $intro, 'lead_product' => $lead, 'accent' => $accent, 'is_core' => $core, 'image' => $img, 'highlights' => $hl, 'sort' => ($i + 1) * 10]);
        }
        foreach (self::services() as $p => $list) {
            foreach ($list as [$slug, $tag, $name, $summary, $desc, $do, $get, $ideal, $img, $sort]) {
                Db::insert('services', [
                    'practice_id' => $pids[$p], 'slug' => $slug, 'tag' => $tag, 'name' => $name, 'summary' => $summary,
                    'description' => $desc, 'do_items' => $do, 'get_items' => $get, 'ideal' => $ideal,
                    'price_from' => 1, 'price_amount' => '', 'price_unit' => '', 'is_active' => 1,
                    'image' => $img, 'sort' => $sort, 'updated_at' => $now,
                ]);
            }
        }
        foreach (self::slides() as $i => [$img, $t, $sub, $link]) {
            Db::insert('slides', ['image' => $img, 'title' => $t, 'subtitle' => $sub, 'link' => $link, 'is_active' => 1, 'sort' => ($i + 1) * 10]);
        }
        foreach (self::levels() as $i => [$name, $aud, $items, $feat]) {
            Db::insert('levels', ['name' => $name, 'audience' => $aud, 'items' => $items, 'price_from' => 1, 'price_amount' => '', 'price_unit' => '', 'featured' => $feat, 'sort' => ($i + 1) * 10]);
        }
        foreach (self::commitments() as $i => [$t, $b]) {
            Db::insert('commitments', ['title' => $t, 'body' => $b, 'sort' => ($i + 1) * 10]);
        }
        foreach (self::steps() as $i => [$t, $b]) {
            Db::insert('steps', ['title' => $t, 'body' => $b, 'sort' => ($i + 1) * 10]);
        }
        foreach (self::offices() as $i => [$c, $code, $city, $r, $d, $email, $hq]) {
            Db::insert('offices', ['country' => $c, 'code' => $code, 'city' => $city, 'region' => $r, 'description' => $d, 'address' => '', 'phone' => '', 'email' => $email, 'is_hq' => $hq, 'sort' => ($i + 1) * 10]);
        }
        foreach (self::industries() as $i => [$slug, $name, $icon, $summary, $msp, $audit, $hz]) {
            Db::insert('industries', ['slug' => $slug, 'name' => $name, 'icon' => $icon, 'image' => 'photos/' . $slug . '.jpg', 'summary' => $summary, 'intro' => '', 'msp' => $msp, 'audit' => $audit, 'horizons' => $hz, 'is_active' => 1, 'sort' => ($i + 1) * 10]);
        }
        foreach (self::products() as $i => [$slug, $name, $label, $summary, $items, $accent, $u, $pimg]) {
            Db::insert('products', ['slug' => $slug, 'name' => $name, 'label' => $label, 'summary' => $summary, 'description' => '', 'items' => $items, 'accent' => $accent, 'external_url' => $u, 'image' => $pimg, 'is_active' => 1, 'sort' => ($i + 1) * 10]);
        }
        foreach (self::clients() as $i => [$name, $cc, $ind, $color]) {
            Db::insert('clients', ['name' => $name, 'country' => $cc, 'industry' => $ind, 'logo_url' => '', 'color' => $color, 'website' => '', 'is_sample' => 1, 'is_active' => 1, 'sort' => ($i + 1) * 10]);
        }
        foreach (self::caseStudies() as $i => [$t, $c, $p, $cc, $ch, $so, $re]) {
            Db::insert('case_studies', ['title' => $t, 'client' => $c, 'pillar' => $p, 'country' => $cc, 'challenge' => $ch, 'solution' => $so, 'result' => $re, 'is_sample' => 1, 'is_active' => 1, 'sort' => ($i + 1) * 10]);
        }
        foreach (self::standards() as $i => [$r, $items]) {
            Db::insert('standards', ['region' => $r, 'items' => $items, 'sort' => ($i + 1) * 10]);
        }
        foreach (self::faqs() as $i => [$q, $a]) {
            Db::insert('faqs', ['question' => $q, 'answer' => $a, 'is_active' => 1, 'sort' => ($i + 1) * 10]);
        }
    }
}
