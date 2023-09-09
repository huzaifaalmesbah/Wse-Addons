<?php
namespace WseAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Widget 2.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Team extends \Elementor\Widget_Base {
    /**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Wse Team';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Wse Team', 'wse-addons' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-inner-section';
	}
	public function get_style_depends() {
		return [ 'team-style', 'elementor-icons-fa-solid' ];
	}
	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */

	

	public function get_custom_help_url() {
		return 'https://huzaifa.im/contact';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'wse-addons' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'wse', 'addons', 'link' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'wse-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'default' => __( 'Team Member Info', 'wse-addons' ),
			]
		);
        $repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'name',
			[
				'label' => __( 'Name', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( 'Boss', 'wse-addons' ),
				'default' => __( 'Huzaifa', 'wse-addons' ),
			]
		);
		$repeater->add_control(
			'role',
			[
				'label' => __( 'Role Name', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'default' => __( 'Wp Developer', 'wse-addons' ),
			]
		);
		$repeater->add_control(
			'discription',
			[
				'label' => __( 'Discription', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'input_type' => 'text',
				'default' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'wse-addons' ),
			]
		);
		$repeater->add_control(
			'email',
			[
				'label' => __( 'email', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'default' => __( 'hello@wse.test', 'wse-addons' ),
			]
		);

        $repeater->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				// 'default' => [
				// 	'url' => \Elementor\Utils::get_placeholder_image_src(),
				// ],
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'default' => __( 'Contact Me', 'wse-addons' ),
			]
		);
		$repeater->add_control(
			'button_url',
			[
				'label' => __( 'Button Url', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'default' => __( 'https://facebook.com', 'wse-addons' ),
			]
		);
		$this->add_control(
			'member-list',
			[
				'label' => __( 'Team Member List', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Title #1', 'wse-addons' ),
						'list_content' => __( 'Item content. Click the edit button to change this text.', 'wse-addons' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);



		$this->end_controls_section();

		// Style Tab Start

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'wse-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#001937',
				'selectors' => [
					'{{WRAPPER}} h2.boss' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'wse-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'name_color',
			[
				'label' => esc_html__( 'Name Color', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#001937',
				'selectors' => [
					'{{WRAPPER}} h2' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
			'role_color',
			[
				'label' => esc_html__( 'Role Color', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#3C368C',
				'selectors' => [
					'{{WRAPPER}} p.title' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_control(
			'discription_color',
			[
				'label' => esc_html__( 'Discription Color', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#7A7A7A',
				'selectors' => [
					'{{WRAPPER}} p.discription' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
			'email_color',
			[
				'label' => esc_html__( 'Email Color', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#7A7A7A',
				'selectors' => [
					'{{WRAPPER}} p.email' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Button Color', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FD8A28',
				'selectors' => [
					'{{WRAPPER}} .button' => 'background-color: {{VALUE}};',
				],
				
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Button Text Color', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .button' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_section();


	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$title = $this->get_settings('title');
		$lists = $this->get_settings('member-list');
		?>
<div class="row">
    <div class="container">
        <h2 class="boss"><?php echo $title; ?> - V <?php echo WSE_ADDONS_VERSION; ?></h2>
    </div>
    <?php
	if($lists){
		foreach($lists as $list){?>
    <div class="column">
        <div class="card">
            <?php if(!empty($list['image']['id'])){?>
            <img src="<?php echo esc_html($list['image']['url']) ?>" alt="<?php echo esc_html($list['name']) ?>"
                style="width:100%"><?php
				}else{
					?> <img src="<?php echo WSE_ADDONS_ASSETS.'/image/boss.jpg' ?>" alt="<?php echo esc_html($list['name']) ?>"
                style="width:100%"><?php
				}
				?>
            <div class="container">
                <h2><?php echo esc_html($list['name']) ?></h2>
                <p class="title"><?php echo esc_html($list['role']) ?></p>
                <p class="discription"><?php echo esc_html($list['discription']) ?></p>
                <p class="email"><?php echo esc_html($list['email']) ?></p>
                <?php if(!empty($list['button_url'])){?>
                <p><a href="<?php echo esc_html($list['button_url']) ?>"><button
                            class="button"><?php echo esc_html($list['button_text']) ?></button></a></p>
                <?php
				}
				?>

            </div>
        </div>
    </div>
    <?php 
	}
}
	?>
</div>

<?php
			
		}
}