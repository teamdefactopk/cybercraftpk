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
            'meta_description' => 'CyberCraft Pvt. Ltd. is a managed services provider and cyber security compliance and audit firm with its own invention lab. Founded in Lahore in 2007, with a presence in Pakistan, the UAE, Saudi Arabia, the UK, the Czech Republic and Canada.',
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
            'stats' => "17+ | Years in technology\n6 | Countries\n24/7 | Operations & security\n20+ | Standards we audit to\n3 | Core pillars",
            'footer_text' => 'Managed services, cyber security compliance and audit, and new inventions, from Pakistan to the world.',
            'show_sample_badges' => '1',
            'content_version' => '3',
        ];
    }

    /** [key, page, label, type, value] */
    public static function blocks(): array
    {
        return [
            ['home_label', 'Home', 'Small line above the headline', 'text', 'Corporate managed service provider · Since 2007'],
            ['home_headline', 'Home', 'Headline', 'text', 'Managed IT services, cyber security and compliance for corporate organizations.'],
            ['home_sub', 'Home', 'Text under the headline', 'textarea', 'We run your servers, networks, cloud and users around the clock, audit and secure them to ISO 27001 and your regulator\'s standards, and deliver solar, automation and AI projects. Offices in Lahore, Dubai, Riyadh, London, Prague and Toronto.'],
            ['home_cta_primary', 'Home', 'Primary button text', 'text', 'Get a free consultation'],
            ['home_cta_secondary', 'Home', 'Secondary button text', 'text', 'See our services'],
            ['home_pillars_title', 'Home', 'Services title', 'text', 'Three core services. One accountable partner.'],
            ['home_pillars_intro', 'Home', 'Services introduction', 'textarea', 'Most clients start with one service. Many combine all three under a single agreement.'],
            ['home_industries_title', 'Home', 'Industries title', 'text', 'Built for regulated, always-on industries.'],
            ['home_industries_intro', 'Home', 'Industries introduction', 'textarea', 'Each pillar, applied to the realities of your sector: its regulators, its uptime demands and its opportunities.'],
            ['home_also_title', 'Home', 'Supporting services title', 'text', 'We also deliver'],
            ['home_products_title', 'Home', 'Products title', 'text', 'Our products and platforms'],
            ['home_clients_title', 'Home', 'Clients title', 'text', 'Trusted by organizations in six countries'],
            ['home_why_title', 'Home', 'Why CyberCraft title', 'text', 'Why organizations choose CyberCraft'],
            ['home_cta_band_title', 'Home', 'Bottom call-to-action title', 'text', 'Talk to us about your IT and security'],
            ['home_cta_band_body', 'Home', 'Bottom call-to-action text', 'textarea', 'Book a free consultation. We review your IT and security and reply with a clear proposal within one business day.'],

            ['ceo_quote', 'About', 'CEO pull-quote', 'textarea', 'Every organization now asks two questions: is our technology secure, and can we prove it? We exist to answer both, and to put new technology to work for our clients.'],
            ['ceo_name', 'About', 'CEO name', 'text', 'Tauseef Ahmed'],
            ['ceo_role', 'About', 'CEO title', 'text', 'Founder & CEO, CyberCraft Pvt. Ltd.'],
            ['ceo_message', 'About', 'CEO message (Markdown)', 'markdown', "When I started CyberCraft in 2007, our goal was simple: help businesses use technology to work better. Over the years we built software, ERP systems, data centers and networks, and our clients trusted us to keep running them. That trust is the heart of our first pillar, managed services.\n\nToday every organization faces the same two questions: is our technology secure, and can we prove it? Our second pillar, cyber security compliance and audit, exists to answer both, honestly and to international standards.\n\nOur third pillar, new inventions and horizons, is our commitment to the future. Clean energy, automation, embedded systems and AI will change how every business works, and we intend to help invent that change, not just watch it.\n\nBecoming CyberCraft Pvt. Ltd. in 2024, and expanding to the UAE, KSA, UK, Czech Republic and Canada, is a new chapter for us. What we stand for has not changed: accountability, honest advice and real value for every client."],
            ['about_title', 'About', 'Page title', 'text', 'From Lahore, since 2007.'],
            ['about_intro', 'About', 'Introduction', 'textarea', 'We started by building systems. Clients asked us to run them, then to secure them. Today we are a corporate managed service provider with our own innovation lab.'],
            ['about_body', 'About', 'Our story (Markdown)', 'markdown', "CyberCraft started in 2007 with a simple idea: **help businesses work better with technology.** Our first work was bringing computers, networks and software into offices across Lahore.\n\nOver the years we built software, our own ERP platform CyberERP, and data centers and networks. Clients kept asking us to stay on and run what we had built, so we became a **managed services provider**, placing resident engineers inside client organizations and, often, running a client's entire IT function.\n\nRunning clients' systems made one thing clear: every system must be secure, and clients must be able to prove it. That became our second pillar, **cyber security compliance and audit**.\n\nIn 2024 we incorporated as **CyberCraft Pvt. Ltd.**, expanded to five more countries and launched our third pillar, **new inventions and horizons**."],
            ['about_timeline', 'About', 'Timeline (one per line: Year | text)', 'lines', "2007 | Founded in Lahore as a sole proprietorship: computerization, networking and software\nGrowth years | CyberERP, data centers, networks, IP communications and surveillance\nGrowth years | Managed services and the resident-engineer model\nGrowth years | Cyber security audit and compliance practice; b2cloud.io launched\n2024 | Incorporated as CyberCraft Pvt. Ltd.: An Innovation Technology Company\n2024 onward | UAE, KSA, UK, Czech Republic and Canada; Horizons lab launched"],
            ['about_vision', 'About', 'Vision', 'textarea', 'To be the trusted partner that runs, secures and reinvents technology for organizations, from Pakistan to the world.'],
            ['about_mission', 'About', 'Mission', 'textarea', "To keep our clients' technology running, secure and compliant through managed services and cyber security assurance, and to invent the solutions that open new horizons for them."],
            ['about_values', 'About', 'Values (one per line: Value | meaning)', 'lines', "Accountability | When we manage a system, we own its outcome\nIntegrity | Honest findings in every audit and honest advice in every proposal\nVigilance | Security and compliance are continuous work, not an annual event\nInnovation | We adapt, innovate and improvise, and invest in new inventions\nValue for money | Enterprise-grade service at a cost that makes sense\nContinuous learning | Threats, standards and technology change, and so do our skills"],
            ['about_partners', 'About', 'Partnerships text (Markdown)', 'markdown', "CyberCraft delivers through its own teams and a network of **joint-venture (JV) partners** in Pakistan and abroad. These partnerships let us bid for and deliver large and government programs, bring in certified auditors, testers and engineers when needed, source equipment competitively and support clients locally in five countries.\n\nWe welcome partnerships with technology vendors, audit firms, system integrators, distributors and investors."],

            ['services_title', 'Services', 'Page title', 'text', 'Everything we deliver'],
            ['services_intro', 'Services', 'Introduction', 'textarea', 'Three core pillars, backed by seventeen years of engineering. Take any service on its own or combine them under one agreement.'],
            ['pillars_title', 'Services', '"What we do" page title', 'text', 'Managed IT, cyber security and innovation'],
            ['pillars_intro', 'Services', '"What we do" introduction', 'textarea', 'Three core services under one accountable partner: we manage your IT, audit and secure it, and deliver new technology such as solar, automation and AI.'],

            ['industries_title', 'Industries', 'Page title', 'text', 'Built for regulated, always-on industries'],
            ['industries_intro', 'Industries', 'Introduction', 'textarea', 'Each pillar, applied to the realities of your sector: its regulators, its uptime demands and its opportunities.'],

            ['products_title', 'Products', 'Page title', 'text', 'Packaged, repeatable, ready to deploy'],
            ['products_intro', 'Products', 'Introduction', 'textarea', 'A lead product for each pillar, and two platforms built in-house.'],

            ['clients_title', 'Clients', 'Page title', 'text', 'Trusted across six countries'],
            ['clients_intro', 'Clients', 'Introduction', 'textarea', 'Corporate, government, healthcare, manufacturing, energy and hospitality organizations rely on CyberCraft to run and secure their IT.'],

            ['careers_title', 'Careers', 'Page title', 'text', 'Build your career at CyberCraft'],
            ['careers_intro', 'Careers', 'Introduction', 'textarea', 'Service desk and NOC engineers, auditors and penetration testers, SOC analysts, solar and automation engineers, developers and ERP consultants.'],
            ['careers_body', 'Careers', 'Main text (Markdown)', 'markdown', "## Why work with us\n- Real responsibility for live client systems\n- Security and audit work to international standards\n- Invention projects in the Horizons lab\n- International exposure across six countries\n- Certification support: ITIL, CEH, OSCP, CISA, ISO 27001 Lead Auditor and more\n\n## Career areas\nManaged services · Cyber security & audit · Horizons R&D · Infrastructure & networks · Cloud · Software & ERP · Sales & business development\n\n## How to apply\nSend your CV and the area you're interested in through the contact form (choose **Careers**) or email careers@cybercraft.biz."],

            ['contact_title', 'Contact', 'Page title', 'text', "Let's talk"],
            ['contact_intro', 'Contact', 'Introduction', 'textarea', 'Tell us what you need and the right team will reply within one business day.'],
            ['contact_success', 'Contact', 'Message shown after sending', 'textarea', "Thank you. Your message has reached the right team and we'll be in touch within one business day."],

            ['privacy_body', 'Legal', 'Privacy policy (Markdown)', 'markdown', "## Who we are\nCyberCraft Pvt. Ltd. (\"we\", \"us\") provides managed services, cyber security compliance and audit, and technology solutions. This policy explains how we handle personal data on this website.\n\n## What we collect\n- Details you send through our contact form: name, email, company, phone, country and your message.\n- Basic technical data needed to run the site securely, such as IP address and browser type.\n\n## How we use it\nWe use your details only to respond to your enquiry and to provide our services. We do not sell personal data.\n\n## Cookies\nThis website uses only essential cookies needed for security and forms. We do not use advertising cookies.\n\n## Your rights\nYou can ask us to access, correct or delete your data at any time by emailing info@cybercraft.biz.\n\n*[Placeholder policy. Please have it reviewed for each country where you operate before launch.]*"],
            ['terms_body', 'Legal', 'Terms of use (Markdown)', 'markdown', "## Website terms\nThis website is provided by CyberCraft Pvt. Ltd. for general information about our services.\n\n## Services\nServices are provided under a separate client agreement, which takes precedence over anything on this website.\n\n## Contact\nQuestions about these terms: info@cybercraft.biz\n\n*[Placeholder terms. Please have them reviewed before launch.]*"],
        ];
    }

    /** [slug, name, short, promise, motto, summary, intro, lead_product, accent, is_core, image] */
    public static function practices(): array
    {
        return [
            ['managed-services', 'Managed IT Services', 'Managed IT Services', 'We run your IT so your team can focus on the business.', '', 'Complete IT outsourcing, resident engineers, service desk and 24/7 monitoring.', 'CyberCraft is a corporate managed service provider. We take responsibility for your servers, networks, cloud, devices and users under agreed service levels, with a 24/7 operations center, monthly reports and security built into everything we manage.', 'Service plans from remote support to full outsourcing', 'msp', 1, 'scenes/managed-it.svg'],
            ['compliance-audit', 'Cyber Security Audit & Compliance', 'Cyber Security & Audit', 'We secure your systems and get you audit-ready.', '', 'Security audits, penetration testing, ISO 27001 and regulatory compliance, 24/7 SOC.', 'Independent security audits and penetration tests against the standards your regulators, customers and board expect, followed by hands-on help to close the gaps and 24/7 monitoring to stay secure. When we also manage your systems, a separate team performs the audit.', 'Audit, compliance readiness and managed SOC', 'audit', 1, 'scenes/cyber-security.svg'],
            ['innovation', 'Innovation & Smart Technology', 'Innovation', 'Solar, automation, IoT and AI that cut costs and add capability.', 'Adapt · Innovate · Improvise', 'Solar and clean energy, industrial automation, IoT, smart buildings and AI.', 'Our innovation lab in Lahore adapts proven global technology to local conditions, designs new solutions and improvises on the ground: power outages, remote sites, tight budgets and harsh environments.', 'Solar, automation, IoT and AI projects', 'horizons', 1, 'scenes/innovation.svg'],
            ['solutions', 'IT Solutions & Infrastructure', 'IT Solutions', 'The engineering behind our services.', '', 'Software and ERP, data centers and networks, cloud hosting, licensing and hardware.', 'Built since 2007, these capabilities support everything we manage and secure, and are also available as projects on their own.', 'CyberERP · b2cloud.io', 'support', 0, 'scenes/network-infrastructure.svg'],
        ];
    }

    /** practice slug => [slug, tag, name, summary, description, do, get, ideal] */
    public static function services(): array
    {
        return [
            'managed-services' => [
                ['it-outsourcing', 'Outsourcing', 'Complete IT Outsourcing', 'We run your entire IT function for a fixed monthly cost.', 'CyberCraft takes over your whole IT function: infrastructure, users, applications, vendors and security, under one agreement and one fixed monthly cost.', "Discovery, documentation and stabilization in the first 30–90 days\nDay-to-day operations of servers, network, cloud and end-user devices\nVendor and ISP management\nMonthly service reviews and roadmaps", "Predictable monthly cost\nSLA-backed response and uptime\nOne accountable partner\nNo hiring or training overhead", 'Organizations without, or outgrowing, an in-house IT team.'],
                ['resident-engineers', 'People', 'Resident Engineers', 'Qualified engineers placed full-time at your site, backed by CyberCraft.', 'Dedicated engineers who work inside your organization every day, supported remotely by our service desk, NOC and specialists.', "Full-time onsite engineers\nBackfill during leave and absence\nRemote escalation to specialists\nIT staff augmentation on demand", "A known face on site\nCyberCraft processes and tools\nFlexible scale up and down", 'Head offices, plants, campuses and branches that need people on site.'],
                ['service-desk-noc', 'Support', 'Service Desk & 24/7 NOC', 'L1–L3 support and round-the-clock monitoring.', 'A multi-channel service desk and a 24/7 network operations center that watches your servers, networks, applications and links.', "L1, L2 and L3 support by phone, email, chat, WhatsApp and remote session\n24/7 monitoring and alerting\nIncident, request, problem and change management (ITIL)\nMonthly SLA reporting", "Faster resolution\nIssues caught before users notice\nFull ticket history and reports", 'Any organization that depends on IT being available.'],
                ['managed-infrastructure-cloud', 'Infrastructure', 'Managed Infrastructure & Cloud', 'Servers, networks, backups and cloud, run and patched for you.', 'We operate your servers, storage, virtualization, networks, firewalls and cloud, on b2cloud.io, AWS, Azure, Google Cloud and Microsoft 365.', "Servers, storage, virtualization, backups and patching\nLAN/WAN, Wi-Fi, SD-WAN and firewall management\nCloud and Microsoft 365 administration\nData center operations", "Hardened, documented environments\nBackups that are tested\nCapacity and cost reviews", 'Organizations running on-premises, cloud or hybrid infrastructure.'],
                ['managed-workplace', 'Workplace', 'Managed Workplace', 'Communications, surveillance and devices, managed as a service.', 'IP telephony, video conferencing, contact center platforms, IP CCTV, access control, laptops, desktops and printers, all managed by CyberCraft.', "IP PBX, VoIP and video conferencing\nIP CCTV, access control and central monitoring\nLaptops, desktops, printers and device lifecycle\nAMC, asset, license and vendor management", "One team for every device\nPredictable support costs\nUp-to-date asset records", 'Offices, branches, hotels and campuses.'],
                ['virtual-cio', 'Advisory', 'Virtual CIO', 'IT strategy, budgets and roadmaps for growing companies.', 'Senior IT leadership on a part-time basis: strategy, budgets, vendor selection and board reporting.', "IT strategy and roadmaps\nBudgeting and vendor selection\nProject and risk oversight\nBoard and management reporting", "Senior expertise without a full-time hire\nClear technology priorities", 'Growing companies without a CIO.'],
            ],
            'compliance-audit' => [
                ['security-audit-vapt', 'Audit', 'Security Audit & VAPT', 'Independent audits and penetration testing with a risk-rated report.', 'Information security audits, gap assessments and vulnerability assessment and penetration testing for networks, web, mobile, APIs, cloud and wireless.', "Security audits and gap assessments\nVAPT: network, web, mobile, API, cloud, wireless\nRed teaming and phishing simulation\nHardening, code and IT general controls reviews\nThird-party and OT/SCADA assessments", "Risk-rated findings with clear remediation steps\nRe-test to confirm closure\nIndependent audit team", 'Corporates, insurers, telecoms, government and any regulated organization.'],
                ['compliance-readiness', 'Compliance', 'Compliance Readiness', 'Get ready for ISO 27001, PCI DSS, SOC 2 and regional regulators.', 'Gap assessment, remediation roadmap, policies, evidence collection, internal audit and support during certification and regulatory inspection.', "Gap assessment and remediation roadmap\nPolicies, standards and procedures\nEvidence collection and internal audit\nSupport during certification and regulator audits\nContinuous compliance dashboards", "Audit-ready, regulator-ready controls\nA clear path to certification", 'Organizations facing a certification, regulator or customer deadline.'],
                ['grc-privacy', 'Governance', 'Governance, Risk & Privacy', 'Risk registers, business continuity, privacy programs and a virtual CISO.', 'The governance that keeps security working: risk management, business continuity, privacy and leadership.', "Risk registers and treatment plans\nBusiness continuity and DR planning and testing\nPrivacy programs, DPIAs and DPO support\nSecurity awareness training\nVirtual CISO and board reporting", "Security leadership on demand\nBoard-ready reporting", 'Boards and executives accountable for cyber risk.'],
                ['managed-soc', 'SOC', 'Managed SOC & Security', '24/7 monitoring, detection, response and protection.', 'A 24/7 security operations center with SIEM monitoring, incident response, and managed protection for endpoints, email, firewalls and identity.', "24/7 SOC and SIEM monitoring\nIncident response and digital forensics\nManaged EDR, email, firewall, MFA, PAM and DLP\nVulnerability management, DDoS protection and WAF", "Threats detected and contained around the clock\nMonthly security reports", 'Organizations without a 24/7 security team.'],
            ],
            'innovation' => [
                ['solar-clean-energy', 'Energy', 'Solar & Clean Energy', 'Solar, storage and EV charging for homes, businesses and telecom sites.', 'Residential, commercial and industrial solar; hybrid and solar–wind systems for telecom sites; battery storage, net metering and EV charging, with monitoring and O&M.', "On-grid, off-grid and hybrid solar\nSolar–wind hybrids for telecom sites\nBattery energy storage and net metering\nEV charging\nEnergy monitoring software and O&M", "Lower energy bills\nBackup through outages\nMonitored performance", 'Homes, factories, hotels, telecom towers and remote sites.'],
                ['industrial-automation', 'Automation', 'Industrial Automation', 'PLC, SCADA, MES, machine vision and Industry 4.0.', 'Automation and control for plants and utilities, from PLC and SCADA to MES, machine vision and predictive maintenance.', "PLC, SCADA, HMI and DCS\nMES and Industry 4.0\nMachine vision and quality inspection\nControl panels, drives and instrumentation\nPredictive maintenance and digital twins", "Higher throughput and quality\nReal-time production visibility", 'Manufacturing, food & beverage, water and energy.'],
                ['embedded-iot', 'IoT', 'Embedded Systems & IoT', 'Custom hardware, firmware, sensors and remote monitoring.', 'We design and build custom electronics and connected devices, and the platforms that monitor them.', "Custom hardware and PCB design\nFirmware development\nSensors, gateways and telemetry\nRemote monitoring dashboards and M2M connectivity", "Devices built for your problem\nData from the field in real time", 'Utilities, agriculture, logistics and product companies.'],
                ['smart-living-cities', 'Smart', 'Smart Living & Smart Cities', 'Smart homes, buildings, metering and intelligent transport.', 'Home automation, smart buildings and BMS, smart metering, street lighting, intelligent transport and city surveillance.', "Home automation\nSmart buildings and BMS\nSmart metering and street lighting\nIntelligent transport and city surveillance", "Lower running costs\nSafer, more comfortable spaces", 'Developers, hotels, municipalities and campuses.'],
                ['artificial-intelligence', 'AI', 'Artificial Intelligence', 'AI assistants, document AI, analytics and computer vision.', 'Practical AI that saves time and money: assistants and chatbots, intelligent document processing, predictive analytics, computer vision and agentic automation.', "AI assistants and chatbots\nIntelligent document processing\nPredictive analytics and computer vision\nAgentic AI automation", "Less manual work\nFaster decisions from your data", 'Corporates, insurers, retailers, hospitals and government.'],
                ['robotics-health-tech', 'R&D', 'Robotics, Health-tech & Beyond', 'Drones, remote patient monitoring and emerging technology R&D.', 'Research and pilots in robotics, drones, health-tech, biotech, blockchain and AR/VR.', "Inspection, survey and agriculture drones\nRemote patient monitoring and wearables\nBiotech and life-science technology\nBlockchain and AR/VR", "Pilots built with you\nA path from prototype to product", 'Organizations exploring new technology.'],
            ],
            'solutions' => [
                ['software-erp', 'Software', 'Software & ERP', 'Web, mobile and desktop apps; CyberERP, Dynamics 365, SAP and Oracle.', 'Custom software and our own ERP platform CyberERP, plus implementation, consultancy and support for Microsoft Dynamics 365, SAP and Oracle.', "Web, mobile and desktop applications\nAPIs, integration, UI/UX, QA and DevOps\nCyberERP implementation\nDynamics 365, SAP and Oracle implementation and support\nIndustry solutions for hospitals, schools, distribution and lending", "Software that fits how you work\nOne partner from build to support", 'Organizations that need custom systems or ERP.'],
                ['infrastructure-telecom', 'Infrastructure', 'Infrastructure & Telecom', 'Data centers, fiber, networks, satellite links, IP telephony and surveillance.', 'Design and build of data centers, networks and communications.', "Data center design and build\nLAN/WAN, fiber and structured cabling, Wi-Fi, SD-WAN\nWireless and satellite links, tower and fiber rollout\nIP PBX, unified communications, IP surveillance and access control", "Standards-based design\nDocumented handover\nOption to have us run it", 'New offices, plants, campuses and telecom operators.'],
                ['cloud-digitization', 'Cloud', 'Cloud & Digitization', 'b2cloud.io hosting, cloud migration, scanning and document management.', 'Hosting and cloud through our brand b2cloud.io, migrations to AWS, Azure and Google Cloud, and digitization of paper records.', "Hosting, VPS, email and ERP hosting on b2cloud.io\nCloud migration and management\nDocument scanning and digital archives\nDocument management systems and workflows", "Local and global cloud options\nSearchable, secure records", 'Organizations moving to the cloud or going paperless.'],
                ['procurement-contact-center', 'Services', 'Procurement & Contact Center', 'Licensing, hardware supply, and an omnichannel contact center with AI agents.', 'Software licensing and IT hardware supply, plus inbound and outbound contact center services with omnichannel support and AI voice agents.', "Software licensing and IT hardware supply\nInbound and outbound contact center\nOmnichannel: voice, chat, email, social, WhatsApp\nAI voice agents alongside human agents", "One supplier for licenses and hardware\nCustomer support in English, Urdu, Arabic and more", 'Growing companies and customer-facing businesses.'],
            ],
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

    /** [slug, name, label, summary, items, accent, url] */
    public static function products(): array
    {
        return [
            ['cybererp', 'CyberERP', 'Our ERP platform', 'Our own ERP for finance, HR and payroll, inventory, sales, POS, manufacturing and reporting.', "Retail & distribution\nManufacturing\nEducation\nHealthcare\nReal estate\nServices", 'sky', ''],
            ['b2cloud', 'b2cloud.io', 'Our cloud & hosting brand', 'Business hosting and cloud: websites, email, servers, backup, disaster recovery and hosted ERP.', "Web hosting and VPS\nDedicated servers\nBusiness email and domains\nBackup and disaster recovery\nColocation\nERP cloud", 'support', 'https://b2cloud.io'],
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
            return; // content already present
        }
        $pids = [];
        foreach (self::practices() as $i => [$slug, $name, $short, $promise, $motto, $summary, $intro, $lead, $accent, $core, $img]) {
            $pids[$slug] = Db::insert('practices', ['slug' => $slug, 'name' => $name, 'short_name' => $short, 'promise' => $promise, 'motto' => $motto, 'summary' => $summary, 'intro' => $intro, 'lead_product' => $lead, 'accent' => $accent, 'is_core' => $core, 'image' => $img, 'sort' => ($i + 1) * 10]);
        }
        $n = 0;
        foreach (self::services() as $p => $list) {
            foreach ($list as [$slug, $tag, $name, $summary, $desc, $do, $get, $ideal]) {
                Db::insert('services', [
                    'practice_id' => $pids[$p], 'slug' => $slug, 'tag' => $tag, 'name' => $name, 'summary' => $summary,
                    'description' => $desc, 'do_items' => $do, 'get_items' => $get, 'ideal' => $ideal,
                    'price_from' => 1, 'price_amount' => '', 'price_unit' => '', 'is_active' => 1,
                    'sort' => (++$n) * 10, 'updated_at' => $now,
                ]);
            }
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
            Db::insert('industries', ['slug' => $slug, 'name' => $name, 'icon' => $icon, 'summary' => $summary, 'intro' => '', 'msp' => $msp, 'audit' => $audit, 'horizons' => $hz, 'is_active' => 1, 'sort' => ($i + 1) * 10]);
        }
        foreach (self::products() as $i => [$slug, $name, $label, $summary, $items, $accent, $u]) {
            Db::insert('products', ['slug' => $slug, 'name' => $name, 'label' => $label, 'summary' => $summary, 'description' => '', 'items' => $items, 'accent' => $accent, 'external_url' => $u, 'is_active' => 1, 'sort' => ($i + 1) * 10]);
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
